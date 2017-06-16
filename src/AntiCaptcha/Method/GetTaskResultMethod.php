<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Method;

use Randock\AntiCaptcha\Task\Task;

class GetTaskResultMethod extends AbstractMethod
{
    /**
     * @var Task
     */
    private $task;

    /**
     * GetTaskResultMethod constructor.
     *
     * @param Task $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param Task $task
     *
     * @return GetTaskResultMethod
     */
    public function setTask(Task $task): GetTaskResultMethod
    {
        $this->task = $task;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'taskId' => $this->getTask()->getId(),
        ];
    }
}
