<?php

namespace Ahmadrosid\Laravel\Anthropic\Contracts;

use Ahmadrosid\Laravel\Anthropic\Responses\CreateResponse;
use Ahmadrosid\Laravel\Anthropic\Responses\StreamResponse;

interface ChatContract
{
    public function create(array $payload): CreateResponse;

    public function createStreamed(array $payload): StreamResponse;
}
