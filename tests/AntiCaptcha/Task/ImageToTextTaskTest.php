<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha\Task;

use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Task\ImageToTextTask;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class ImageToTextTaskTest extends TestCase
{
    /**
     * @var int
     */
    const MIN_LENGTH = 1231;

    /**
     * @var int
     */
    const MAX_LENGTH = 39493;

    /**
     * @var string
     */
    const BODY = 'asdf9DF(DSFJDF';

    /**
     * Test instance of task is task.
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(ImageToTextTask::class, self::newImageToTextTask());
    }

    public function testDefaults()
    {
        $imageToTextTask = self::newImageToTextTask();
        $this->assertNull($imageToTextTask->getBody());
        $this->assertFalse($imageToTextTask->getMath());
        $this->assertFalse($imageToTextTask->getPhrase());
        $this->assertTrue($imageToTextTask->getCaseSensitive());
        $this->assertSame(0, $imageToTextTask->getMinLength());
        $this->assertSame(0, $imageToTextTask->getMaxLength());
        $this->assertSame(ImageToTextTask::NUMERIC_NO_LIMITS, $imageToTextTask->getNumeric());
    }

    /**
     * Test if the class converts to array correctly
     */
    public function testToArray()
    {

        $imageToTextTask = self::newImageToTextTask();
        $imageToTextTask->setBody(self::BODY);

        $expected = [
            'task' => [

                'type' => ImageToTextTask::TASK_TYPE,
                'body' => self::BODY,
                'phrase' => false,
                'case' => true,
                'numeric' => ImageToTextTask::NUMERIC_NO_LIMITS,
                'math' => false,
                'minLength' => 0,
                'maxLength' => 0,
            ]
        ];

        $this->assertSame($expected, $imageToTextTask->toArray());
    }

    /**
     * Test if all getters and setters are working
     */
    public function testGettersAndSetters()
    {
        $imageToTextTask = self::newImageToTextTask();

        // case sensitive
        $imageToTextTask->setCaseSensitive(false);
        $this->assertFalse($imageToTextTask->getCaseSensitive());

        // phrase
        $imageToTextTask->setPhrase(true);
        $this->assertTrue($imageToTextTask->getPhrase());

        // math
        $imageToTextTask->setMath(true);
        $this->assertTrue($imageToTextTask->getMath());

        // body
        $imageToTextTask->setBody(self::BODY);
        $this->assertSame(self::BODY, $imageToTextTask->getBody());

        // min length
        $imageToTextTask->setMinLength(self::MIN_LENGTH);
        $this->assertSame(self::MIN_LENGTH, $imageToTextTask->getMinLength());

        // max length
        $imageToTextTask->setMaxLength(self::MAX_LENGTH);
        $this->assertSame(self::MAX_LENGTH, $imageToTextTask->getMaxLength());

        // numeric
        $imageToTextTask->setNumeric(ImageToTextTask::NUMERIC_ONLY_LETTERS);
        $this->assertSame(ImageToTextTask::NUMERIC_ONLY_LETTERS, $imageToTextTask->getNumeric());
    }

    /**
     * Test setting the body of the task from a filename
     */
    public function testSetBodyFromFile() {

        // path to file
        $filename = dirname(__FILE__) . '/../../captcha.png';

        // set the body
        $task = self::newImageToTextTask();
        $task->setBodyFromFile($filename);

        // should be the base64 encoded contents
        $this->assertSame(
            base64_encode(file_get_contents($filename)),
            $task->getBody()
        );

        // test exception
        $this->expectException(FileNotFoundException::class);
        $task->setBodyFromFile('xx');

    }

    /**
     * @return ImageToTextTask
     */
    public static function newImageToTextTask(): ImageToTextTask
    {
        return new ImageToTextTask();
    }
}