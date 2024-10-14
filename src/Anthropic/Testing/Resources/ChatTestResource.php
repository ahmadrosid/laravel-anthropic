<?php

namespace Ahmadrosid\Laravel\Anthropic\Testing\Resources;

use Ahmadrosid\Laravel\Anthropic\Responses\CreateResponse;
use Ahmadrosid\Laravel\Anthropic\Responses\StreamResponse;
use Ahmadrosid\Laravel\Anthropic\Concerns\Testable;
use Ahmadrosid\Laravel\Anthropic\Contracts\ChatContract;
use Ahmadrosid\Laravel\Anthropic\Resources\Chat;

final class ChatTestResource implements ChatContract
{
    use Testable;

    public function create(array $payload): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function createStreamed(array $payload): StreamResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    protected function resource(): string
    {
        return Chat::class;
    }
}
