<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Task;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Task\NoCaptchaProxylessTask;

class NoCaptchaProxylessTaskTest extends TestCase
{
    /**
     * @var string
     */
    const WEBSITE_URL = 'http://www.google.nl';

    /**
     * @var string
     */
    const WEBSITE_KEY = 'asdf9df(S_221111';

    /**
     * @var string
     */
    const NEW_WEBSITE_URL = 'http://www.nu.nl';

    /**
     * @var string
     */
    const NEW_WEBSITE_KEY = 'xxsadfasdf@#!#$(S_221111';

    /**
     * Test instance of task is task.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(NoCaptchaProxylessTask::class, self::newNoCaptchaProxylessTask());
    }

    /**
     * Test if the class converts to array correctly
     */
    public function testToArray()
    {

        $noCaptchaProxylessTask = self::newNoCaptchaProxylessTask();

        $expected = [
            'type' => NoCaptchaProxylessTask::TASK_TYPE,
            'websiteURL' => self::WEBSITE_URL,
            'websiteKey' => self::WEBSITE_KEY
        ];

        $this->assertSame($expected, $noCaptchaProxylessTask->toArray());
    }

    /**
     * Test if all getters and setters are working
     */
    public function testGettersAndSetters()
    {
        $noCaptchaProxylessTask = self::newNoCaptchaProxylessTask();

        // website url
        $noCaptchaProxylessTask->setWebsiteUrl(self::NEW_WEBSITE_URL);
        $this->assertSame(self::NEW_WEBSITE_URL, $noCaptchaProxylessTask->getWebsiteUrl());

        // phrase
        $noCaptchaProxylessTask->setWebsiteKey(self::NEW_WEBSITE_KEY);
        $this->assertSame(self::NEW_WEBSITE_KEY, $noCaptchaProxylessTask->getWebsiteKey());
    }

    public function testConstructor() {
        $noCaptchaProxylessTask = self::newNoCaptchaProxylessTask();
        $this->assertSame(self::WEBSITE_URL, $noCaptchaProxylessTask->getWebsiteUrl());
        $this->assertSame(self::WEBSITE_KEY, $noCaptchaProxylessTask->getWebsiteKey());
    }

    /**
     * @return NoCaptchaProxylessTask
     */
    public static function newNoCaptchaProxylessTask(): NoCaptchaProxylessTask
    {
        return new NoCaptchaProxylessTask(self::WEBSITE_URL, self::WEBSITE_KEY);
    }
}