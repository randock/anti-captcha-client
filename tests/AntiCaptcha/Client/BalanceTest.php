<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Client;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Balance;
use Tests\Randock\AntiCaptcha\ClientTest;
use Randock\AntiCaptcha\Exception\InvalidRequestException;

class BalanceTest extends TestCase
{
    /**
     * Test that the balance is returned correctly formatted.
     */
    public function testBalance()
    {
        $body = [
            'errorId' => 0,
            'balance' => 12.43,
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $balance = $client->getBalance();
        $this->assertInstanceOf(Balance::class, $balance);
        $this->assertSame($body['balance'], $balance->getBalance());
    }

    /**
     * Test that an exception is thrown if errors are returned.
     */
    public function testBalanceException()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionCode(InvalidRequestException::ERROR_IP_BLOCKED);

        $body = ClientTest::exceptionBody(InvalidRequestException::ERROR_IP_BLOCKED);
        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $client->getBalance();
    }
}
