<?php

namespace Ahmadrosid\Laravel\Anthropic\Responses;

final class CreateStreamedResponseChoice
{

    private function __construct(
        public readonly int $index,
        public readonly ?CreateStreamedResponseDelta $delta,
    ) {
    }

    public static function from(array $eventData) : self {
        return new self(
            $eventData['index'],
            isset($eventData['delta']) ? CreateStreamedResponseDelta::from($eventData['delta']) : null
        );
    }

    public function toArray() {
        return [
            'index' => $this->index,
            'delta' => $this->delta->toArray()
        ];
    }
}
