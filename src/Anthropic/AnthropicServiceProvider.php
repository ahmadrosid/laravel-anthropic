<?php

namespace Ahmadrosid\Laravel\Anthropic;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Ahmadrosid\Laravel\Anthropic\Anthropic;
use Ahmadrosid\Laravel\Anthropic\Client;
use Ahmadrosid\Laravel\Anthropic\Contracts\ClientContract;

final class AnthropicServiceProvider extends BaseServiceProvider implements DeferrableProvider
{

    public function register(): void
    {
        $this->app->singleton(ClientContract::class, static function (): Client {
            $apiKey = env('ANTHROPIC_API_KEY');
            $headers = [
                'anthropic-version' => '2023-06-01',
                'anthropic-beta' => 'messages-2023-12-15',
                'content-type' => 'application/json',
                'x-api-key' => $apiKey
            ];

            return Anthropic::factory()
                ->withHeaders($headers)
                ->make();
        });

        $this->app->alias(ClientContract::class, 'anthropic');
        $this->app->alias(ClientContract::class, Client::class);
    }

    public function provides(): array
    {
        return [
            Client::class,
            ClientContract::class,
            'anthropic',
        ];
    }
}
