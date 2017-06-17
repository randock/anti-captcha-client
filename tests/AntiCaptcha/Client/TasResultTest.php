<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Client;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Task\Task;
use Randock\AntiCaptcha\TaskResult;
use Tests\Randock\AntiCaptcha\ClientTest;
use Randock\AntiCaptcha\Solution\NoCaptchaSolution;
use Randock\AntiCaptcha\Solution\ImageToTextSolution;
use Randock\AntiCaptcha\Exception\InvalidRequestException;
use Randock\AntiCaptcha\Exception\UnknownSolutionException;

class TasResultTest extends TestCase
{
    /**
     * Test image to text success result.
     */
    public function testImageToTextSuccess()
    {
        $body = [
            'errorId' => 0,
            'status' => 'ready',
            'solution' => [
                'text' => 'bla',
                'url' => 'http://bla',
            ],
            'cost' => '0.0007',
            'ip' => '127.0.0.1',
            'createTime' => 1472205564,
            'endTime' => 1472205570,
            'solveCount' => '0',
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body))
            ]
        );

        $taskResult = $client->getTaskResult(self::newTask());

        /** @var ImageToTextSolution $solution */
        $solution = $taskResult->getSolution();
        $this->assertInstanceOf(TaskResult::class, $taskResult);
        $this->assertInstanceOf(ImageToTextSolution::class, $solution);

        // check solution
        $this->assertSame($body['solution']['text'], $solution->getText());
        $this->assertSame($body['solution']['url'], $solution->getUrl());

        // check task result
        $this->assertSame(TaskResult::STATUS_READY, $taskResult->getStatus());
        $this->assertSame((float) $body['cost'], $taskResult->getCost());
        $this->assertSame($body['ip'], $taskResult->getIp());
        $this->assertSame((int) $body['solveCount'], $taskResult->getSolveCount());

        $this->assertEquals(new \DateTime(sprintf('@%s', $body['createTime'])), $taskResult->getCreateTime());
        $this->assertEquals(new \DateTime(sprintf('@%s', $body['endTime'])), $taskResult->getEndTime());
    }

    /**
     * Test image to text success result.
     */
    public function testNoCaptchaSuccess()
    {
        $body = [
            'errorId' => 0,
            'status' => 'ready',
            'solution' => [
                'gRecaptchaResponse' => 'bla',
            ],
            'cost' => '0.0007',
            'ip' => '127.0.0.1',
            'createTime' => 1472205564,
            'endTime' => 1472205570,
            'solveCount' => '0',
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $taskResult = $client->getTaskResult(self::newTask());

        /** @var NoCaptchaSolution $solution */
        $solution = $taskResult->getSolution();
        $this->assertInstanceOf(TaskResult::class, $taskResult);
        $this->assertInstanceOf(NoCaptchaSolution::class, $solution);

        // check solution
        $this->assertSame($body['solution']['gRecaptchaResponse'], $solution->getGRecaptchaResponse());

        // check task result
        $this->assertSame(TaskResult::STATUS_READY, $taskResult->getStatus());
        $this->assertSame((float) $body['cost'], $taskResult->getCost());
        $this->assertSame($body['ip'], $taskResult->getIp());
        $this->assertSame((int) $body['solveCount'], $taskResult->getSolveCount());

        $this->assertEquals(new \DateTime(sprintf('@%s', $body['createTime'])), $taskResult->getCreateTime());
        $this->assertEquals(new \DateTime(sprintf('@%s', $body['endTime'])), $taskResult->getEndTime());
    }

    public function testTaskPending()
    {
        $body = [
                'errorId' => 0,
                'status' => 'processing',
            ];

        $client = ClientTest::newClient(
                [
                    new Response(200, [], json_encode($body)),
                ]
            );

        $taskResult = $client->getTaskResult(self::newTask());
        $this->assertSame(TaskResult::STATUS_PROCESSING, $taskResult->getStatus());

        $this->assertNull($taskResult->getSolution());
        $this->assertNull($taskResult->getCost());
        $this->assertNull($taskResult->getIp());
        $this->assertNull($taskResult->getSolveCount());
        $this->assertNull($taskResult->getCreateTime());
        $this->assertNull($taskResult->getEndTime());
    }

    /**
     * Test a solution type that is not configured.
     */
    public function testUnknownSolutionType()
    {
        $body = [
            'errorId' => 0,
            'status' => 'ready',
            'solution' => [
                'fake_solution' => 'bla',
            ],
            'cost' => '0.0007',
            'ip' => '127.0.0.1',
            'createTime' => 1472205564,
            'endTime' => 1472205570,
            'solveCount' => '0',
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $this->expectException(UnknownSolutionException::class);
        $taskResult = $client->getTaskResult(self::newTask());
    }

    /**
     * Test that an exception is thrown if errors are returned.
     */
    public function testTaskResultException()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionCode(InvalidRequestException::ERROR_IP_BLOCKED);

        $body = ClientTest::exceptionBody(InvalidRequestException::ERROR_IP_BLOCKED);
        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $client->getTaskResult(self::newTask());
    }

    /**
     * @return Task
     */
    public static function newTask(): Task
    {
        return new Task(1);
    }
}
