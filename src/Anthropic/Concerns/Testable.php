<?php

namespace Ahmadrosid\Laravel\Anthropic\Concerns;

use Ahmadrosid\Laravel\Anthropic\Testing\ClientFake;
use Ahmadrosid\Laravel\Anthropic\Testing\TestRequest;

trait Testable
{

    public function __construct(protected ClientFake $fake)
    {
    }

    abstract protected function resource(): string;

    protected function record(string $method, array $args)
    {
        return $this->fake->record(new TestRequest($this->resource(), $method, $args));
    }
}
