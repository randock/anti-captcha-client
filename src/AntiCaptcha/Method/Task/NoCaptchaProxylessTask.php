<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Method\Task;

class NoCaptchaProxylessTask extends AbstractTask
{
    /**
     * @var string
     */
    public const TASK_TYPE = 'NoCaptchaTaskProxyless';

    /**
     * @var string
     */
    private $websiteUrl;

    /**
     * @var string
     */
    private $websiteKey;

    /**
     * @return string
     */
    public function getWebsiteUrl(): string
    {
        return $this->websiteUrl;
    }

    /**
     * @param string $websiteUrl
     *
     * @return NoCaptchaProxylessTask
     */
    public function setWebsiteUrl(string $websiteUrl): NoCaptchaProxylessTask
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsiteKey()
    {
        return $this->websiteKey;
    }

    /**
     * @param mixed $websiteKey
     *
     * @return NoCaptchaProxylessTask
     */
    public function setWebsiteKey($websiteKey)
    {
        $this->websiteKey = $websiteKey;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'type' => self::TASK_TYPE,
            'websiteURL' => $this->getWebsiteUrl(),
            'websiteKey' => $this->getWebsiteKey(),
        ];
    }
}
