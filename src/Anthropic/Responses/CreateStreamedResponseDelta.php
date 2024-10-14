<?php

namespace Ahmadrosid\Laravel\Anthropic\Responses;

final class CreateStreamedResponseDelta
{

    private function __construct(
        // fixme only supports text delta types
        public readonly string $role,
        public readonly string $type,
        public readonly string $content,
    ) {
    }

    public static function from(array $eventDelta) : self {
        return new self(
            'assistant',
            $eventDelta['type'],
            $eventDelta['text'],
        );
    }

    public function toArray()
    {
        return [
            'role' => $this->role,
            'content' => $this->content
        ];
    }
}
