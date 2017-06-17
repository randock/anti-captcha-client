<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Solution;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Solution\NoCaptchaSolution;

class NoCaptchaSolutionTest extends TestCase
{
    /**
     * @var string
     */
    public const NO_GCAPTCHA_RESPONSE = 'aa';

    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(NoCaptchaSolution::class, self::newNoCaptchaSolution());
    }

    /**
     * Test getters and setters.
     */
    public function testGettersAndSetters()
    {
        $noCaptchaSolution = self::newNoCaptchaSolution();
        $this->assertSame(self::NO_GCAPTCHA_RESPONSE, $noCaptchaSolution->getGRecaptchaResponse());
    }

    /**
     * @return NoCaptchaSolution
     */
    public static function newNoCaptchaSolution(): NoCaptchaSolution
    {
        return new NoCaptchaSolution(self::NO_GCAPTCHA_RESPONSE);
    }
}
