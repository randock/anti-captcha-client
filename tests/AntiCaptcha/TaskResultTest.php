<?php

namespace Tests\Randock\AntiCaptcha;

use Randock\AntiCaptcha\TaskResult;
use PHPUnit\Framework\TestCase;
use Tests\Randock\AntiCaptcha\Solution\ImageToTextSolutionTest;

class TaskResultTest extends TestCase
{

    /**
     * @var string
     */
    const IP = '127.0.0.1';

    /**
     * @var int
     */
    const SOLVE_COUNT = 123;

    /**
     * @var int
     */
    const CREATE_TIME = 1497631070;

    /**
     * @var int
     */
    const END_TIME = 1497631080;

    /**
     * @var float
     */
    const COST = 0.007;


    /**
     * @var string
     */
    const STATUS = TaskResult::STATUS_READY;

    /**
     * Test the instance of
     */
    public function testInstanceOf()
    {
        $taskResult = self::newTaskResult();
        $this->assertInstanceOf( TaskResult::class, $taskResult);
    }

    /**
     * Test getters and setters
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
     * @return TaskResult
     */
    public static function newTaskResult(): TaskResult
    {
        return new TaskResult(TaskResult::STATUS_READY);
    }

}
