<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Balance;

class BalanceTest extends TestCase
{
    /**
     * @var float
     */
    public const BALANCE = 25.32;

    public function testInstanceOf()
    {
        $balance = self::newBalance();
        $this->assertInstanceOf(Balance::class, $balance);
    }

    public function testGettersAndSetters()
    {
        $balance = self::newBalance();
        $this->assertSame(self::BALANCE, $balance->getBalance());
    }

    /**
     * @return Balance
     */
    public static function newBalance(): Balance
    {
        return new Balance(self::BALANCE);
    }
}
