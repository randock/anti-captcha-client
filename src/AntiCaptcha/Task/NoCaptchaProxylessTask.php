<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Task;

use Randock\AntiCaptcha\Definition\ArraySerializable;

class NoCaptchaProxylessTask extends Task implements ArraySerializable
{
    /**
     * @var string
     */
    public const TASK_TYPE = 'NoCaptchaTaskProxyless';

    /**
     * @var string
     */
    private $websiteUrl = null;

    /**
     * @var string
     */
    private $websiteKey = null;

    /**
     * NoCaptchaProxylessTask constructor.
     *
     * @param string   $websiteUrl
     * @param string   $websiteKey
     * @param int|null $id
     */
    public function __construct(string $websiteUrl, string $websiteKey, int $id = null)
    {
        parent::__construct($id);
        $this->websiteUrl = $websiteUrl;
        $this->websiteKey = $websiteKey;
    }

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
            'task' => [
                'type' => self::TASK_TYPE,
                'websiteURL' => $this->getWebsiteUrl(),
                'websiteKey' => $this->getWebsiteKey(),
            ],
        ];
    }
}
