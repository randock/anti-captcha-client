<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Task;

use Randock\AntiCaptcha\Definition\ArraySerializable;

class Task implements ArraySerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * Task constructor.
     *
     * @param int $taskId
     */
    public function __construct($taskId = null)
    {
        $this->id = $taskId;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Task
     */
    public function setId(int $id): Task
    {
        $this->id = $id;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }
}
