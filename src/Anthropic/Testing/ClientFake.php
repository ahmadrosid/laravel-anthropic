<?php

namespace Ahmadrosid\Laravel\Anthropic\Testing;

use Throwable;
use Ahmadrosid\Laravel\Anthropic\Contracts\ClientContract;
use Ahmadrosid\Laravel\Anthropic\Contracts\ChatContract;
use Ahmadrosid\Laravel\Anthropic\Testing\Resources\ChatTestResource;

class ClientFake implements ClientContract
{
    /**
     * @var array<array-key, TestRequest>
     */
    private array $requests = [];

    public function __construct(protected array $responses = [])
    {
    }

    /**
     * @throws Throwable
     */
    public function record(TestRequest $request)
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses);

        if (is_null($response)) {
            throw new \Exception('No fake responses left.');
        }

        if ($response instanceof Throwable) {
            throw $response;
        }

        return $response;
    }

    public function addResponses(array $responses): void
    {
        $this->responses = [...$this->responses, ...$responses];
    }

    public function chat(): ChatContract
    {
        return new ChatTestResource($this);
    }
}
