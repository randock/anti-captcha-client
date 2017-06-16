<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Client;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Task\Task;
use Tests\Randock\AntiCaptcha\ClientTest;
use Randock\AntiCaptcha\Task\ImageToTextTask;
use Randock\AntiCaptcha\Task\NoCaptchaProxylessTask;
use Randock\AntiCaptcha\Exception\InvalidRequestException;

class CreateTaskTest extends TestCase
{
    public function testCreateImageToTextCaptchaSuccess()
    {
        $body = [
            'errorId' => 0,
            'taskId' => 123456,
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $task = new ImageToTextTask();

        $task = $client->createTask($task);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertSame($body['taskId'], $task->getId());
    }

    public function testCreateNoCaptchaSuccess()
    {
        $body = [
            'errorId' => 0,
            'taskId' => 123456,
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $task = new NoCaptchaProxylessTask('http://www.google.nl', 'xxxx');

        $task = $client->createTask($task);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertSame($body['taskId'], $task->getId());
    }

    public function testCreateTaskException()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionCode(InvalidRequestException::ERROR_IP_BLOCKED);

        $body = ClientTest::exceptionBody(InvalidRequestException::ERROR_IP_BLOCKED);
        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $task = new NoCaptchaProxylessTask('http://www.google.nl', 'xxxx');
        $client->createTask($task);
    }
}
