<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Method;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Method\GetBalanceMethod;

class GetBalanceMethodTest extends TestCase
{
    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(GetBalanceMethod::class, self::newGetBalanceMethod());
    }

    /**
     * Test conversion to array.
     */
    public function testToArray()
    {
        $getBalanceMethod = self::newGetBalanceMethod();
        $expected = [];
        $this->assertSame($expected, $getBalanceMethod->toArray());
    }

    /**
     * @return GetBalanceMethod
     */
    public static function newGetBalanceMethod(): GetBalanceMethod
    {
        return new GetBalanceMethod();
    }
}
