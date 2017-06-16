<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Solution;

class NoCaptchaSolution extends AbstractSolution
{
    /**
     * @var string
     */
    private $gRecaptchaResponse;

    /**
     * NoCaptchaSolution constructor.
     *
     * @param string $gRecaptchaResponse
     */
    public function __construct($gRecaptchaResponse)
    {
        $this->gRecaptchaResponse = $gRecaptchaResponse;
    }

    /**
     * @return string
     */
    public function getGRecaptchaResponse(): string
    {
        return $this->gRecaptchaResponse;
    }
}
