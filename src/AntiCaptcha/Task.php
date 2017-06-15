<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha;

class Task
{
    /**
     * @var int
     */
    private $taskId;

    /**
     * Task constructor.
     *
     * @param int $taskId
     */
    public function __construct($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     *
     * @return Task
     */
    public function setTaskId(int $taskId): Task
    {
        $this->taskId = $taskId;

        return $this;
    }
}
