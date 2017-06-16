<?php

namespace Tests\Randock\AntiCaptcha\Solution;

use Randock\AntiCaptcha\Solution\NoCaptchaSolution;
use PHPUnit\Framework\TestCase;

class NoCaptchaSolutionTest extends TestCase
{

    /**
     * @var string
     */
    const NO_GCAPTCHA_RESPONSE = 'aa';

    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(NoCaptchaSolution::class, self::newNoCaptchaSolution());
    }

    /**
     * Test getters and setters
     */
    public function testGettersAndSetters()
    {
        $noCaptchaSolution = self::newNoCaptchaSolution();
        $this->assertSame(self::NO_GCAPTCHA_RESPONSE, $noCaptchaSolution->getGRecaptchaResponse());
    }

    /**
     * @return NoCaptchaSolution
     */
    public static function newNoCaptchaSolution(): NoCaptchaSolution {
        return new NoCaptchaSolution(self::NO_GCAPTCHA_RESPONSE);
    }
}
