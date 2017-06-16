<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Method;

use Randock\AntiCaptcha\Task\Task;

class CreateTaskMethod extends AbstractMethod
{
    /**
     * English language queue.
     *
     * @var string
     */
    public const LANGUAGE_POOL_EN = 'en';

    /**
     * group of countries: Russia, Ukraine, Belarus, Kazakhstan.
     *
     * @var string
     */
    public const LANGUAGE_POOL_RN = 'rn';
    /**
     * @var Task
     */
    private $task;

    /**
     * @var string
     */
    private $languagePool = self::LANGUAGE_POOL_EN;

    /**
     * @var int
     */
    private $softId = null;

    /**
     * CreateTaskMethod constructor.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $task = $this->task->toArray();
        $task['softId'] = $this->getSoftId();
        $task['languagePool'] = $this->getLanguagePool();

        return $task;
    }

    /**
     * @param string $languagePool
     *
     * @return CreateTaskMethod
     */
    public function setLanguagePool(string $languagePool): CreateTaskMethod
    {
        $this->languagePool = $languagePool;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguagePool(): string
    {
        return $this->languagePool;
    }

    /**
     * @param int $softId
     *
     * @return CreateTaskMethod
     */
    public function setSoftId(int $softId): CreateTaskMethod
    {
        $this->softId = $softId;

        return $this;
    }

    /**
     * @return int
     */
    public function getSoftId(): ?int
    {
        return $this->softId;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }
}
