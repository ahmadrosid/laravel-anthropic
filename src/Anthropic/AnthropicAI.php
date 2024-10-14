<?php

namespace Ahmadrosid\Laravel\Anthropic;

use Illuminate\Support\Facades\Facade;
use Ahmadrosid\Laravel\Anthropic\Testing\ClientFake;

/**
 * @method static \Ahmadrosid\Laravel\Anthropic\Resources\Chat chat()
 */
class AnthropicAI extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'anthropic';
    }

    public static function fake(array $responses = []): ClientFake
    {
        $fake = new ClientFake($responses);
        self::swap($fake);

        return $fake;
    }
}
