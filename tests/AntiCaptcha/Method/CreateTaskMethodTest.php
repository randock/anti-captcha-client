<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Method;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Method\CreateTaskMethod;
use Tests\Randock\AntiCaptcha\Task\NoCaptchaProxylessTaskTest;

class CreateTaskMethodTest extends TestCase
{
    /**
     * @var int
     */
    public const SOFT_ID = 1193;

    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(CreateTaskMethod::class, self::newCreateTaskMethod());
    }

    public function testGettersAndSetters()
    {
        $createTaskMethod = self::newCreateTaskMethod();

        // language pool test
        $createTaskMethod->setLanguagePool(CreateTaskMethod::LANGUAGE_POOL_RN);
        $this->assertSame(CreateTaskMethod::LANGUAGE_POOL_RN, $createTaskMethod->getLanguagePool());

        // soft id test
        $createTaskMethod->setSoftId(self::SOFT_ID);
        $this->assertSame(self::SOFT_ID, $createTaskMethod->getSoftId());
    }

    public function testToArray()
    {
        $createTaskMethod = self::newCreateTaskMethod();
        $taskArray = $createTaskMethod->getTask()->toArray();

        $expected = [
            'softId' => $createTaskMethod->getSoftId(),
            'languagePool' => $createTaskMethod->getLanguagePool(),
        ];
        $expected = array_merge($taskArray, $expected);
        $this->assertSame($expected, $createTaskMethod->toArray());
    }

    /**
     * @return CreateTaskMethod
     */
    public static function newCreateTaskMethod(): CreateTaskMethod
    {
        return new CreateTaskMethod(NoCaptchaProxylessTaskTest::newNoCaptchaProxylessTask());
    }
}
