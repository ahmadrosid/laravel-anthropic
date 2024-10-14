<?php

namespace Ahmadrosid\Laravel\Anthropic\Testing\Responses\Concerns;

use Http\Discovery\Psr17FactoryDiscovery;
use Ahmadrosid\Laravel\Anthropic\Responses\StreamResponse;

trait FakeableForStreamedResponse
{
    /**
     * @param  resource  $resource
     */
    public static function fake($resource = null): StreamResponse
    {
        if ($resource === null) {
            $filename = str_replace(['App\\Lib\\Anthropic\\Responses', '\\'], [__DIR__.'/../Fixtures/', '/'], static::class).'Fixture.txt';
            $resource = fopen($filename, 'r');
        }

        $stream = Psr17FactoryDiscovery::findStreamFactory()
            ->createStreamFromResource($resource);

        $response = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withBody($stream);

        return new StreamResponse($response);
    }
}
