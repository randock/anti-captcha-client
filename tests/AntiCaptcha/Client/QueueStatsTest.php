<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Client;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\QueueStats;
use Tests\Randock\AntiCaptcha\ClientTest;
use Randock\AntiCaptcha\Exception\InvalidRequestException;

class QueueStatsTest extends TestCase
{
    /**
     * Test that the balance is returned correctly formatted.
     */
    public function testQueueStats()
    {
        $body = [
            'waiting' => 223,
            'load' => 60.33,
            'bid' => '0.00078322',
            'speed' => 10.77,
            'total' => 1032,
        ];

        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $queueStats = $client->getQueueStats(1);
        $this->assertInstanceOf(QueueStats::class, $queueStats);
        $this->assertSame($body['waiting'], $queueStats->getWaiting());
        $this->assertSame($body['load'], $queueStats->getLoad());
        $this->assertSame((float) $body['bid'], $queueStats->getBid());
        $this->assertSame($body['speed'], $queueStats->getSpeed());
        $this->assertSame($body['total'], $queueStats->getTotal());
    }

    /**
     * Test that an exception is thrown if errors are returned.
     */
    public function testQueueStatsException()
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionCode(InvalidRequestException::ERROR_IP_BLOCKED);

        $body = ClientTest::exceptionBody(InvalidRequestException::ERROR_IP_BLOCKED);
        $client = ClientTest::newClient(
            [
                new Response(200, [], json_encode($body)),
            ]
        );

        $client->getQueueStats(1);
    }
}
