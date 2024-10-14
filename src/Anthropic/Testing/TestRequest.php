<?php

namespace Ahmadrosid\Laravel\Anthropic\Testing;

final class TestRequest
{

    public function __construct(protected string $resource, protected string $method, protected array $args)
    {
    }

    public function resource(): string
    {
        return $this->resource;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function args(): array
    {
        return $this->args;
    }
}
