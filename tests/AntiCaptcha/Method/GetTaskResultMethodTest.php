<?php

namespace Tests\Randock\AntiCaptcha\Method;

use Randock\AntiCaptcha\Method\GetTaskResultMethod;
use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Task\ImageToTextTask;
use Tests\Randock\AntiCaptcha\Task\ImageToTextTaskTest;
use Tests\Randock\AntiCaptcha\Task\NoCaptchaProxylessTaskTest;

class GetTaskResultMethodTest extends TestCase
{
    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(GetTaskResultMethod::class, self::newGetTaskResultMethod());
    }

    /**
     * Test conversion to array
     */
    public function testToArray()
    {
        $getTaskResultMethod = self::newGetTaskResultMethod();
        $expected = [
            'taskId' => $getTaskResultMethod->getTask()->getId()
        ];
        $this->assertSame($expected, $getTaskResultMethod->toArray());
    }

    public function testConstructor()
    {
        $task = ImageToTextTaskTest::newImageToTextTask();
        $getTaskResultMethod = new GetTaskResultMethod($task);
        $this->assertSame($task, $getTaskResultMethod->getTask());
    }

    /**
     * Test the getters and setters
     */
    public function testGettersAndSetters()
    {
        $getTaskResultMethod = self::newGetTaskResultMethod();

        // task
        $task = NoCaptchaProxylessTaskTest::newNoCaptchaProxylessTask();
        $getTaskResultMethod->setTask($task);
        $this->assertSame($task, $getTaskResultMethod->getTask());

    }

    /**
     * @return GetTaskResultMethod
     */
    public static function newGetTaskResultMethod(): GetTaskResultMethod
    {
        return new GetTaskResultMethod(ImageToTextTaskTest::newImageToTextTask());
    }
}
