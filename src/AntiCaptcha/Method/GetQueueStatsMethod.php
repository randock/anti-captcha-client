<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Method;

class GetQueueStatsMethod extends AbstractMethod
{
    /**
     * @var int
     */
    public const QUEUE_ENGLISH_IMAGE_TO_TEXT = 1;

    /**
     * @var int
     */
    public const QUEUE_RUSSIAN_IMAGE_TO_TEXT = 2;

    /**
     * @var int
     */
    public const QUEUE_SQUARE_RECAPTCHA = 3;

    /**
     * @var int
     */
    public const QUEUE_AUDIO_CAPTCHA = 4;

    /**
     * @var int
     */
    public const QUEUE_RECAPTCHA = 5;

    /**
     * @var int
     */
    public const QUEUE_RECAPTCHA_PROXYLESS = 6;

    /**
     * @var int
     */
    private $queueId;

    /**
     * GetQueueStatsMethod constructor.
     *
     * @param int $queueId
     */
    public function __construct($queueId)
    {
        $this->queueId = $queueId;
    }

    /**
     * @return int
     */
    public function getQueueId(): int
    {
        return $this->queueId;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'queueId' => $this->getQueueId(),
        ];
    }
}
