<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Method;

class GetTaskResultMethod extends AbstractMethod
{
    /**
     * @var int
     */
    private $taskId;

    /**
     * GetTaskResultMethod constructor.
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
     * @return GetTaskResultMethod
     */
    public function setTaskId(int $taskId): GetTaskResultMethod
    {
        $this->taskId = $taskId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'taskId' => $this->getTaskId(),
        ];
    }
}
