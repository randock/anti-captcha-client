<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Task;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Task\Task;

class TaskTest extends TestCase
{

    /**
     * @var int
     */
    const ID = 1;

    /**
     * @var int
     */
    const NEW_ID = 2;

    /**
     * Test instance of task is task.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(Task::class, self::newTask());
    }

    
    /**
     * Test conversion to array
     */
    public function testToArray()
    {
        $task = self::newTask();
        $expected = [
            'id' => $task->getId()
        ];

        $this->assertSame($expected, $task->toArray());
    }

    /**
     * Test getters and setters
     */
    public function testGettersAndSetters()
    {
        $task = self::newTask();
        $task->setId(self::NEW_ID);
        $this->assertSame(self::NEW_ID, $task->getId());
    }

    /**
     * @return Task
     */
    public static function newTask(): Task
    {
        return new Task(self::ID);
    }
}
