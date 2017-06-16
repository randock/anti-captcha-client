<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha;

use Randock\AntiCaptcha\Solution\AbstractSolution;

class TaskResult
{
    /**
     * @var string
     */
    public const STATUS_READY = 'ready';

    /**
     * @var string
     */
    public const STATUS_PROCESSING = 'processing';

    /**
     * @var string
     */
    private $status;

    /**
     * @var AbstractSolution
     */
    private $solution = null;

    /**
     * @var float
     */
    private $cost = null;

    /**
     * @var string
     */
    private $ip = null;

    /**
     * @var \DateTime
     */
    private $createTime = null;

    /**
     * @var \DateTime
     */
    private $endTime = null;

    /**
     * @var int
     */
    private $solveCount = null;

    /**
     * TaskResult constructor.
     *
     * @param string $status
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return AbstractSolution
     */
    public function getSolution(): ?AbstractSolution
    {
        return $this->solution;
    }

    /**
     * @return float
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @return \DateTime
     */
    public function getCreateTime(): ?\DateTime
    {
        return $this->createTime;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    /**
     * @return int
     */
    public function getSolveCount(): ?int
    {
        return $this->solveCount;
    }

    /**
     * @param AbstractSolution $solution
     *
     * @return TaskResult
     */
    public function setSolution(AbstractSolution $solution): TaskResult
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * @param float $cost
     *
     * @return TaskResult
     */
    public function setCost(float $cost): TaskResult
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @param string $ip
     *
     * @return TaskResult
     */
    public function setIp(string $ip): TaskResult
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @param \DateTime $createTime
     *
     * @return TaskResult
     */
    public function setCreateTime(\DateTime $createTime): TaskResult
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @param \DateTime $endTime
     *
     * @return TaskResult
     */
    public function setEndTime(\DateTime $endTime): TaskResult
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @param int $solveCount
     *
     * @return TaskResult
     */
    public function setSolveCount(int $solveCount): TaskResult
    {
        $this->solveCount = $solveCount;

        return $this;
    }
}
