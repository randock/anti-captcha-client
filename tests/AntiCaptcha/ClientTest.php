<?php

declare(strict_types=1);

namespace Tests\Randock\AntiCaptcha;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Randock\AntiCaptcha\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Client as GuzzleClient;
use Randock\AntiCaptcha\Exception\InvalidRequestException;

class ClientTest extends TestCase
{
    /**
     * @var string
     */
    public const API_KEY = '111';
    public const NEW_API_KEY = '112';

    public function testInstanceOf()
    {
        $client = self::newClient();
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testConstructor()
    {
        $client = self::newClient();
        $this->assertSame(self::API_KEY, $client->getApiKey());
    }

    public function testGettersSetters()
    {
        $client = self::newClient();

        // api key
        $client->setApiKey(self::NEW_API_KEY);
        $this->assertSame(self::NEW_API_KEY, $client->getApiKey());
    }

    public function testDefaultGuzzleClient()
    {
        $client = self::newClient();
        $this->assertInstanceOf(GuzzleClient::class, $client->getHttpClient());
    }

    public function testStatusCodeFailure()
    {
        $this->expectException(InvalidRequestException::class);
        $client = self::newClient(
            [
                new Response(301),
            ]
        );

        $client->getBalance();
    }

    public function testInvalidJsonResponse()
    {
        $this->expectException(InvalidRequestException::class);
        $client = self::newClient(
            [
                new Response(200, [], 'asdf'),
            ]
        );

        $client->getBalance();
    }

    /**
     * @param GuzzleClient|null $guzzleClient
     *
     * @return Client
     */
    public static function newClient(array $responses = null): Client
    {
        $client = new Client(self::API_KEY);
        if ($responses !== null) {
            $client->setHttpClient(
                self::newMockGuzzleClient($responses)
            );
        }

        return $client;
    }

    /**
     * @param array $responses
     *
     * @return GuzzleClient
     */
    public static function newMockGuzzleClient(array $responses): GuzzleClient
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);

        return new GuzzleClient(['handler' => $handler]);
    }

    /**
     * @param int $code
     *
     * @return array
     */
    public static function exceptionBody(int $code): array
    {
        return [
            'errorId' => $code,
            'errorDescription' => sprintf('The description for the %d error code', $code),
            'errorCode' => sprintf('ERROR_CODE_%d', $code),
        ];
    }
}
