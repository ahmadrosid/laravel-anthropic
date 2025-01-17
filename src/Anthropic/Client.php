<?php

namespace Ahmadrosid\Laravel\Anthropic;

use Ahmadrosid\Laravel\Anthropic\Resources\Chat;
use Ahmadrosid\Laravel\Anthropic\Contracts\ClientContract;
use Ahmadrosid\Laravel\Anthropic\Resources\Model;

class Client implements ClientContract
{
    private Factory $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function chat(): Contracts\ChatContract
    {
        return new Chat($this->factory);
    }

    public function model(): Model
    {
        return new Model();
    }
}
