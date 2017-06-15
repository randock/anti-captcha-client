<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha;

use GuzzleHttp\Client as GuzzleClient;
use Randock\AntiCaptcha\Method\AbstractMethod;
use Randock\AntiCaptcha\Method\GetBalanceMethod;
use Randock\AntiCaptcha\Method\Task\AbstractTask;
use Randock\AntiCaptcha\Method\GetQueueStatsMethod;
use Randock\AntiCaptcha\Exception\InvalidRequestException;

class Client
{
    /**
     * @var string
     */
    private $apiKey;

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
     * @param AbstractTask $task
     *
     * @return Task
     */
    public function createTask(AbstractTask $task): Task
    {
        $response = $this->handle('createTask', $task);

        return new Task($response->taskId);
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

        $client = new GuzzleClient();
        $response = $client->post(sprintf('https://api.anti-captcha.com/%s', $path), [
            'json' => $data,
        ]);

        // check if the response was "successful"
        if ($response->getStatusCode() !== 200) {
            throw new InvalidRequestException($response->getReasonPhrase());
        }

        // check for valid json
        $json = json_decode((string) $response->getBody());
        if ($json === null) {
            throw new InvalidRequestException($response->getBody());
        }

        // even though it appears to have succeeded, errors are returned in the body
        if (isset($json->errorId) && $json->errorId !== 0) {
            throw new InvalidRequestException($json->errorDescription, $json->errorId);
        }

        // all good
        return $json;
    }
}
