<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\TaskResult;
use Tests\Randock\AntiCaptcha\Solution\ImageToTextSolutionTest;

class TaskResultTest extends TestCase
{
    /**
     * @var string
     */
    public const IP = '127.0.0.1';

    /**
     * @var int
     */
    public const SOLVE_COUNT = 123;

    /**
     * @var int
     */
    public const CREATE_TIME = 1497631070;

    /**
     * @var int
     */
    public const END_TIME = 1497631080;

    /**
     * @var float
     */
    public const COST = 0.007;

    /**
     * @var string
     */
    public const STATUS = TaskResult::STATUS_READY;

    /**
     * Test the instance of.
     */
    public function testInstanceOf()
    {
        $taskResult = self::newTaskResult();
        $this->assertInstanceOf(TaskResult::class, $taskResult);
    }

    /**
     * Test getters and setters.
     */
    public function testConstructor()
    {
        $taskResult = self::newTaskResult();
        $this->assertSame(self::STATUS, $taskResult->getStatus());
    }

    public function testGettersAndSetters()
    {
        $taskResult = self::newTaskResult();

        // ip
        $taskResult->setIp(self::IP);
        $this->assertSame(self::IP, $taskResult->getIp());

        // solve count
        $taskResult->setSolveCount(self::SOLVE_COUNT);
        $this->assertSame(self::SOLVE_COUNT, $taskResult->getSolveCount());

        // create time
        $date = new \DateTime(sprintf('@%s', self::CREATE_TIME));
        $taskResult->setCreateTime($date);
        $this->assertSame($date, $taskResult->getCreateTime());

        // end time
        $date = new \DateTime(sprintf('@%s', self::END_TIME));
        $taskResult->setEndTime($date);
        $this->assertSame($date, $taskResult->getEndTime());

        // cost
        $taskResult->setCost(self::COST);
        $this->assertSame(self::COST, $taskResult->getCost());

        // solution
        $solution = ImageToTextSolutionTest::newImageToTextSolution();
        $taskResult->setSolution($solution);
        $this->assertSame($solution, $taskResult->getSolution());
    }

    /**
     * Check if the isReady method works as expected.
     */
    public function testIsReady()
    {
        // ready
        $taskResult = new TaskResult(TaskResult::STATUS_READY);
        $this->assertTrue($taskResult->isReady());

        // not ready
        $taskResult = new TaskResult(TaskResult::STATUS_PROCESSING);
        $this->assertFalse($taskResult->isReady());
    }

    /**
     * Check if the isProcessing method works as expected.
     */
    public function testIsProcessing()
    {
        // ready
        $taskResult = new TaskResult(TaskResult::STATUS_READY);
        $this->assertFalse($taskResult->isProcessing());

        // not ready
        $taskResult = new TaskResult(TaskResult::STATUS_PROCESSING);
        $this->assertTrue($taskResult->isProcessing());
    }

    /**
     * @return TaskResult
     */
    public static function newTaskResult(): TaskResult
    {
        return new TaskResult(TaskResult::STATUS_READY);
    }
}
