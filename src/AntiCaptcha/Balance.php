<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha;

class Balance
{
    /**
     * @var float
     */
    private $balance;

    /**
     * Balance constructor.
     *
     * @param float $balance
     */
    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }
}
