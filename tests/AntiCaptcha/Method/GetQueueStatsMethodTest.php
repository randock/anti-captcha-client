<?php

namespace Tests\Randock\AntiCaptcha\Method;

use Randock\AntiCaptcha\Method\GetQueueStatsMethod;
use PHPUnit\Framework\TestCase;

class GetQueueStatsMethodTest extends TestCase
{
    /**
     * @var int
     */
    const QUEUE_ID = GetQueueStatsMethod::QUEUE_ENGLISH_IMAGE_TO_TEXT;

    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(GetQueueStatsMethod::class, self::newGetQueueStatsMethod());
    }

    /**
     * Test the constructor
     */
    public function testConstructor()
    {
        $getQueueStatsMethod = self::newGetQueueStatsMethod();
        $this->assertSame(self::QUEUE_ID, $getQueueStatsMethod->getQueueId());
    }

    /**
     * Test conversion to array
     */
    public function testToArray()
    {
        $getQueueStatsMethod = self::newGetQueueStatsMethod();
        $expected = [
            'queueId' => $getQueueStatsMethod->getQueueId()
        ];
        $this->assertSame($expected, $getQueueStatsMethod->toArray());
    }

    public function testGettersAndSetters()
    {
        $getQueueStatsMethod = self::newGetQueueStatsMethod();
        $this->assertSame(self::QUEUE_ID, $getQueueStatsMethod->getQueueId());
    }

    /**
     * @return GetQueueStatsMethod
     */
    public static function newGetQueueStatsMethod(): GetQueueStatsMethod
    {
        return new GetQueueStatsMethod(self::QUEUE_ID);
    }
}
