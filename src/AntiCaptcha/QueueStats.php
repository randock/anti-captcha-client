<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha;

class QueueStats
{
    /**
     * @var int
     */
    private $waiting;

    /**
     * @var float
     */
    private $load;

    /**
     * @var float
     */
    private $bid;

    /**
     * @var float
     */
    private $speed;

    /**
     * @var int
     */
    private $total;

    /**
     * QueueStats constructor.
     *
     * @param int   $waiting
     * @param float $load
     * @param float $bid
     * @param float $speed
     * @param int   $total
     */
    public function __construct(int $waiting, float $load, float $bid, float $speed, int $total)
    {
        $this->waiting = $waiting;
        $this->load = $load;
        $this->bid = $bid;
        $this->speed = $speed;
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getWaiting(): int
    {
        return $this->waiting;
    }

    /**
     * @return float
     */
    public function getLoad(): float
    {
        return $this->load;
    }

    /**
     * @return float
     */
    public function getBid(): float
    {
        return $this->bid;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
