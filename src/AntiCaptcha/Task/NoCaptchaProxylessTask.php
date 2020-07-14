<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Task;

use Randock\AntiCaptcha\Definition\ArraySerializable;

class NoCaptchaProxylessTask extends Task implements ArraySerializable
{
    const DEFAULT_MIN_SCORE = 0.9;

    /**
     * @var string
     */
    public const TASK_TYPE = 'NoCaptchaTaskProxyless';

    /**
     * @var string
     */
    public const TASK_TYPE_V3 = 'RecaptchaV3TaskProxyless';

    /**
     * @var string
     */
    private $selectedTaskType;

    /**
     * @var float|null
     */
    private $minScore;

    /**
     * @var string|null
     */
    private $pageAction;

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
     * @param string      $websiteUrl
     * @param string      $websiteKey
     * @param int|null    $id
     * @param int         $version
     * @param float|null $minScore
     * @param string|null $pageAction
     */
    public function __construct(
        string $websiteUrl,
        string $websiteKey,
        int $id = null,
        int $version = 2,
        ?float $minScore = null,
        ?string $pageAction = null
    )
    {
        parent::__construct($id);
        $this->websiteUrl = $websiteUrl;
        $this->websiteKey = $websiteKey;

        switch ($version) {
            case 3:
                $this->selectedTaskType = self::TASK_TYPE_V3;
                $this->minScore = $minScore;
                $this->pageAction = $pageAction;
                break;
            default:
                $this->selectedTaskType = self::TASK_TYPE;
                break;
        }
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
     * @return string
     */
    public function getSelectedTaskType(): string
    {
        return $this->selectedTaskType;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $taskData = [
            'type' => $this->getSelectedTaskType(),
            'websiteURL' => $this->getWebsiteUrl(),
            'websiteKey' => $this->getWebsiteKey(),
        ];

        if( self::TASK_TYPE_V3 === $this->getSelectedTaskType() ){
            $taskData['minScore'] = $this->minScore ?? self::DEFAULT_MIN_SCORE;
            $taskData['pageAction'] = $this->pageAction ?? \md5((string) \time());
        }

        return [
            'task' => $taskData,
        ];
    }
}
