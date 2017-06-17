<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha;

use Randock\AntiCaptcha\Task\Task;
use GuzzleHttp\Client as GuzzleClient;
use Randock\AntiCaptcha\Method\AbstractMethod;
use Randock\AntiCaptcha\Method\CreateTaskMethod;
use Randock\AntiCaptcha\Method\GetBalanceMethod;
use Randock\AntiCaptcha\Method\GetQueueStatsMethod;
use Randock\AntiCaptcha\Method\GetTaskResultMethod;
use Randock\AntiCaptcha\Solution\NoCaptchaSolution;
use Randock\AntiCaptcha\Solution\ImageToTextSolution;
use Randock\AntiCaptcha\Exception\InvalidRequestException;
use Randock\AntiCaptcha\Exception\UnknownSolutionException;

class Client
{
    /**
     * @var string
     */
    private $apiKey = null;

    /**
     * @var GuzzleClient
     */
    private $httpClient = null;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return Client
     */
    public function setApiKey(string $apiKey): Client
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Retrieve the balance of your account.
     *
     * @return Balance
     */
    public function getBalance()
    {
        $response = $this->handle('getBalance', new GetBalanceMethod());

        return new Balance($response->balance);
    }

    /**
     * Retrieve the stats of the system in the queue specified.
     *
     * @param $queueId
     *
     * @return QueueStats
     */
    public function getQueueStats($queueId)
    {
        $response = $this->handle('getQueueStats', new GetQueueStatsMethod($queueId));

        return new QueueStats(
            $response->waiting,
            $response->load,
            (float) $response->bid,
            $response->speed,
            $response->total
        );
    }

    /**
     * Create a captcha task.
     *
     * @param CreateTaskMethod $task
     *
     * @return Task
     */
    public function createTask(Task $task): Task
    {
        $response = $this->handle('createTask', new CreateTaskMethod($task));
        $task->setId($response->taskId);

        return $task;
    }

    /**
     * @param Task $task
     *
     * @return TaskResult
     */
    public function getTaskResult(Task $task): TaskResult
    {
        $response = $this->handle('getTaskResult', new GetTaskResultMethod($task));

        $taskResult = new TaskResult($response->status);
        if ($taskResult->getStatus() === TaskResult::STATUS_READY) {
            $taskResult->setCost((float) $response->cost);
            $taskResult->setCreateTime(new \DateTime(sprintf('@%s', $response->createTime)));
            $taskResult->setEndTime(new \DateTime(sprintf('@%s', $response->endTime)));
            $taskResult->setIp($response->ip);
            $taskResult->setSolveCount((int) $response->solveCount);

            if (isset($response->solution->text)) {
                $solution = new ImageToTextSolution($response->solution->text, $response->solution->url);
                $taskResult->setSolution($solution);
            } elseif (isset($response->solution->gRecaptchaResponse)) {
                $solution = new NoCaptchaSolution($response->solution->gRecaptchaResponse);
                $taskResult->setSolution($solution);
            } else {
                throw new UnknownSolutionException();
            }
        }

        return $taskResult;
    }

    /**
     * @param GuzzleClient $httpClient
     *
     * @return Client
     */
    public function setHttpClient(GuzzleClient $httpClient): Client
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @return GuzzleClient
     */
    public function getHttpClient(): GuzzleClient
    {
        if ($this->httpClient === null) {
            $this->httpClient = new GuzzleClient();
        }

        return $this->httpClient;
    }

    /**
     * Handles the request and returns the response.
     *
     * @param string         $path
     * @param AbstractMethod $method
     *
     * @return mixed
     */
    private function handle(string $path, AbstractMethod $method): \stdClass
    {
        $data = $method->toArray();
        $data['clientKey'] = $this->getApiKey();

        $client = $this->getHttpClient();
        $response = $client->post(
            sprintf(
                'https://api.anti-captcha.com/%s',
                $path
            ), [
                'json' => $data,
            ]
        );

        // check if the response was "successful"
        if ($response->getStatusCode() !== 200) {
            throw new InvalidRequestException($response->getReasonPhrase());
        }

        // check for valid json
        $json = json_decode((string) $response->getBody());
        if ($json === null) {
            throw new InvalidRequestException((string) $response->getBody());
        }

        // even though it appears to have succeeded, errors are returned in the body
        if (isset($json->errorId) && $json->errorId !== 0) {
            throw new InvalidRequestException($json->errorDescription, $json->errorId);
        }

        // all good
        return $json;
    }
}
