<?php

namespace Tests\Randock\AntiCaptcha;

use Randock\AntiCaptcha\Balance;
use PHPUnit\Framework\TestCase;

class BalanceTest extends TestCase
{
    /**
     * @var float
     */
    const BALANCE = 25.32;

    public function testInstanceOf()
    {
        $balance = self::newBalance();
        $this->assertInstanceOf( Balance::class, $balance);
    }

    public function testGettersAndSetters()
    {
        $balance = self::newBalance();
        $this->assertSame(self::BALANCE, $balance->getBalance());
    }

    /**
     * @return Balance
     */
    public static function newBalance(): Balance {
        return new Balance(self::BALANCE);
    }
}
