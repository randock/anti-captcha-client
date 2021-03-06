[![Build Status](https://travis-ci.org/randock/anti-captcha-client.svg?branch=master)](https://travis-ci.org/randock/anti-captcha-client)

Anti-captcha API
===============
This library integrates the https://anti-captcha.com API in PHP.

## Installing ##
The easiest way to install the library is using composer:

```bash
composer require randock/anti-captcha-client
```

## Usage ##
The library can be used by creating an instance of the client and calling the appropriate methods.

For example, to create a new task:

```php
<?php

use Randock\AntiCaptcha\Client;
use Randock\AntiCaptcha\Task\ImageToTextTask;
use Randock\AntiCaptcha\Solution\ImageToTextSolution;
use Randock\AntiCaptcha\Exception\InvalidRequestException;

// create a new client
$client = new Client('<<API KEY>>');

// create the task to be send
$task = new ImageToTextTask();

// set the body
$task->setBody('<<BASE 64 of captcha>>');
//$task->setBodyFromFile($file);

try {
    // send the task to anti-captcha.com
    $task = $client->createTask($task);

    do {
        // wait a bit before (re)trying
        sleep(2);

        $taskResult = $client->getTaskResult($task);
    } while ($taskResult->isProcessing());

    /* @var ImageToTextSolution $solution */
    $solution = $taskResult->getSolution();

    // grab captcha text
    $captcha = $solution->getText();
} catch (InvalidRequestException $exception) {
}

```
