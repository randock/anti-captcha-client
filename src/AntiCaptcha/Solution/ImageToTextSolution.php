<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Solution;

class ImageToTextSolution extends AbstractSolution
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $url;

    /**
     * ImageToTextSolution constructor.
     *
     * @param string $text
     * @param string $url
     */
    public function __construct($text, $url)
    {
        $this->text = $text;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
