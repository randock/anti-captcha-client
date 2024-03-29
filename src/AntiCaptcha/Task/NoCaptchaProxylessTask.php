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
     * @var string
     */
    private $websiteUrl = null;

    /**
     * @var string
     */
    private $websiteKey = null;

    /**
     * @var string|null
     */
    private $action;

    /**
     * @var bool
     */
    private $enterprise = false;

    /**
     * @param string      $websiteUrl
     * @param string      $websiteKey
     * @param int|null    $id
     * @param int         $version
     * @param float|null  $minScore
     * @param string|null $action
     * @param bool        $enterprise
     */
    public function __construct(
        string $websiteUrl,
        string $websiteKey,
        int $id = null,
        int $version = 2,
        ?float $minScore = null,
        ?string $action = null,
        bool $enterprise = false
    )
    {
        parent::__construct($id);
        $this->websiteUrl = $websiteUrl;
        $this->websiteKey = $websiteKey;
        $this->enterprise = $enterprise;

        switch ($version) {
            case 3:
                $this->selectedTaskType = self::TASK_TYPE_V3;
                $this->minScore = $minScore;
                $this->action = $action;
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
     * @return bool
     */
    public function isEnterprise(): bool
    {
        return $this->enterprise;
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
            'isEnterprise' => $this->isEnterprise(),
        ];

        if( self::TASK_TYPE_V3 === $this->getSelectedTaskType() ){
            $taskData['minScore'] = $this->minScore ?? 0.9;
            $taskData['pageAction'] = $this->action ?? \md5((string) \time());
        }

        return [
            'task' => $taskData,
        ];
    }
}
