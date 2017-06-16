<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Task;

use Randock\AntiCaptcha\Definition\ArraySerializable;

class ImageToTextTask extends Task implements ArraySerializable
{
    /**
     * @var string
     *
     * The task type used in the api call
     */
    public const TASK_TYPE = 'ImageToTextTask';

    /**
     * @var int
     */
    public const NUMERIC_NO_LIMITS = 0;

    /**
     * @var int
     */
    public const NUMERIC_ONLY_NUMBERS = 1;

    /**
     * @var int
     */
    public const NUMERIC_ONLY_LETTERS = 2;

    /**
     * @var string
     *
     * Base64 body of the image to solve
     */
    private $body = null;

    /**
     * @var bool
     *
     * True: the captcha has at least two words
     * False: one word
     */
    private $phrase = false;

    /**
     * @var bool
     *
     * True: the captcha is case sensitive
     * False: the captcha isn't case sensitive
     */
    private $caseSensitive = true;

    /**
     * @var int
     *
     * 0 - no requirements
     * 1 - only numbers are allowed
     * 2 - only letters are allowed
     */
    private $numeric = self::NUMERIC_NO_LIMITS;

    /**
     * @var bool
     *
     * True: the captcha is a match question
     * False: it's a regular captcha
     */
    private $math = false;

    /**
     * @var int
     *
     * The min length of the captcha
     *
     * 0: no limit
     */
    private $minLength = 0;

    /**
     * @var int
     *
     * The max length of the captcha
     *
     * 0: no limit
     */
    private $maxLength = 0;

    /**
     * @return string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return ImageToTextTask
     */
    public function setBody(string $body): ImageToTextTask
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPhrase(): bool
    {
        return $this->phrase;
    }

    /**
     * @param bool $phrase
     *
     * @return ImageToTextTask
     */
    public function setPhrase(bool $phrase): ImageToTextTask
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCaseSensitive(): bool
    {
        return $this->caseSensitive;
    }

    /**
     * @param bool $caseSensitive
     *
     * @return ImageToTextTask
     */
    public function setCaseSensitive(bool $caseSensitive): ImageToTextTask
    {
        $this->caseSensitive = $caseSensitive;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumeric(): int
    {
        return $this->numeric;
    }

    /**
     * @param int $numeric
     *
     * @return ImageToTextTask
     */
    public function setNumeric(int $numeric): ImageToTextTask
    {
        $this->numeric = $numeric;

        return $this;
    }

    /**
     * @return bool
     */
    public function getMath(): bool
    {
        return $this->math;
    }

    /**
     * @param bool $math
     *
     * @return ImageToTextTask
     */
    public function setMath(bool $math): ImageToTextTask
    {
        $this->math = $math;

        return $this;
    }

    /**
     * @return int
     */
    public function getMinLength(): int
    {
        return $this->minLength;
    }

    /**
     * @param int $minLength
     *
     * @return ImageToTextTask
     */
    public function setMinLength(int $minLength): ImageToTextTask
    {
        $this->minLength = $minLength;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     *
     * @return ImageToTextTask
     */
    public function setMaxLength(int $maxLength): ImageToTextTask
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            'type' => self::TASK_TYPE,
            'body' => $this->getBody(),
            'phrase' => $this->getPhrase(),
            'case' => $this->getCaseSensitive(),
            'numeric' => $this->getNumeric(),
            'math' => $this->getMath(),
            'minLength' => $this->getMinLength(),
            'maxLength' => $this->getMaxLength(),
        ];
    }
}
