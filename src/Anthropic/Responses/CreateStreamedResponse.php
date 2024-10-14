<?php

namespace Ahmadrosid\Laravel\Anthropic\Responses;

use Ahmadrosid\Laravel\Anthropic\Testing\Responses\Concerns\FakeableForStreamedResponse;

final class CreateStreamedResponse
{
    use FakeableForStreamedResponse;

    /**
     * @param  array<int, CreateStreamedResponseChoice>  $choices
     */
    private function __construct(
        public readonly array $choices,
        public readonly ?CreateStreamedResponseUsage $usage,
    ) {
    }

    public static function from(array $eventData): self
    {
        return new self(
            isset($eventData['index']) ? [CreateStreamedResponseChoice::from($eventData)] : [],
            CreateStreamedResponseUsage::from($eventData)
        );
    }

    public function toArray()
    {
        return [
            'choices' => $this->choices,
        ];
    }
}
