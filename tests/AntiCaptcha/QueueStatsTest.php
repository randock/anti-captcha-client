<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\QueueStats;

class QueueStatsTest extends TestCase
{
    /**
     * @var int
     */
    public const WAITING = 123;

    /**
     * @var float
     */
    public const LOAD = 25.123;

    /**
     * @var float
     */
    public const BID = 0.007;

    /**
     * @var float
     */
    public const SPEED = 23.22;

    /**
     * @var int
     */
    public const TOTAL = 123;

    /**
     * @var float
     */
    public const BALANCE = 25.32;

    /**
     * Test the instance of.
     */
    public function testInstanceOf()
    {
        $balance = self::newQueueStats();
        $this->assertInstanceOf(QueueStats::class, $balance);
    }

    /**
     * Test getters and setters.
     */
    public function testGettersAndSetters()
    {
        $queueStats = self::newQueueStats();
        $this->assertSame(self::WAITING, $queueStats->getWaiting());
        $this->assertSame(self::LOAD, $queueStats->getLoad());
        $this->assertSame(self::BID, $queueStats->getBid());
        $this->assertSame(self::SPEED, $queueStats->getSpeed());
        $this->assertSame(self::TOTAL, $queueStats->getTotal());
    }

    /**
     * @return QueueStats
     */
    public static function newQueueStats(): QueueStats
    {
        return new QueueStats(self::WAITING, self::LOAD, self::BID, self::SPEED, self::TOTAL);
    }
}
