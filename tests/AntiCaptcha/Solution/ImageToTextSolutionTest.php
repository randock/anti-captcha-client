<?php

namespace Tests\Randock\AntiCaptcha\Solution;

use Randock\AntiCaptcha\Solution\ImageToTextSolution;
use PHPUnit\Framework\TestCase;

class ImageToTextSolutionTest extends TestCase
{

    /**
     * @var string
     */
    const TEXT = 'aa';

    /**
     * @var string
     */
    const URL = 'http://www.google.nl';

    /**
     * Test right instance.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(ImageToTextSolution::class, self::newImageToTextSolution());
    }

    /**
     * Test getters and setters
     */
    public function testGettersAndSetters()
    {
        $imageToTextSolution = self::newImageToTextSolution();
        $this->assertSame(self::TEXT, $imageToTextSolution->getText());
        $this->assertSame(self::URL, $imageToTextSolution->getUrl());
    }

    /**
     * @return ImageToTextSolution
     */
    public static function newImageToTextSolution(): ImageToTextSolution {
        return new ImageToTextSolution(self::TEXT, self::URL);
    }
}
