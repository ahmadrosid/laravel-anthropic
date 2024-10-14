<?php

namespace Ahmadrosid\Laravel\Anthropic\Resources;

use Ahmadrosid\Laravel\Anthropic\Factory;
use Ahmadrosid\Laravel\Anthropic\Responses\CreateResponse;
use Ahmadrosid\Laravel\Anthropic\Responses\StreamResponse;
use GuzzleHttp\Client as GuzzleClient;
use Ahmadrosid\Laravel\Anthropic\Contracts\ChatContract;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Exception;

class Chat implements ChatContract {

    private Factory $factory;
    private GuzzleClient $client;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
        $this->client = new GuzzleClient([
            'base_uri'        => $factory->baseUri,
            'timeout'         => $factory->timeout,
            'allow_redirects' => false,
        ]);
    }

    /**
     * Example payload
     * [
     *      'model' => 'claude-3-opus-20240229',
     *      'temperature' => $temperature,
     *      'max_tokens' => 1024,
     *      'system' => $systemMessage,
     *      'messages' => $messages,
     * ]
     * @throws GuzzleException|JsonException
     * @throws Exception
     */
    public function create(array $payload): CreateResponse
    {
        $response = $this->client->post('messages', [
            'headers' => $this->factory->headers,
            'json' => $payload,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception("Request failed with code {$response->getStatusCode()}");
        }

        $responseBody = $response->getBody()->getContents();

        $response = json_decode($responseBody, true, flags: JSON_THROW_ON_ERROR);

        if (isset($response['error'])) {
            throw new Exception($response['error']);
        }

        return CreateResponse::from($response);
    }

    /**
     * Example payload
     * [
     *      'model' => 'claude-3-opus-20240229',
     *      'messages' => $messages,
     *      'max_tokens' => 1024,
     *      'stream' => true
     * ]
     * @throws GuzzleException
     */
    public function createStreamed(array $payload): StreamResponse
    {
        try {
            $payload['stream'] = true;
            $response = $this->client->post('messages', [
                'headers' => $this->factory->headers,
                'json' => $payload,
                'stream' => true
            ]);

            return new StreamResponse($response);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
