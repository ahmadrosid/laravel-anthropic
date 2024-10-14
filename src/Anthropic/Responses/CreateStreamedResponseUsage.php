<?php

namespace Ahmadrosid\Laravel\Anthropic\Responses;

final class CreateStreamedResponseUsage
{
    private function __construct(
        public readonly int $promptTokens = 0,
        public readonly int $completionTokens = 0,
    ) {
    }

    public static function from(array $eventData): self
    {
        $usage = ['input_tokens' => 0, 'output_tokens' => 0];
        if (isset($eventData['message']['usage'])) {
            $usage = $eventData['message']['usage'];
        } else if (isset($eventData['usage'])) {
            $usage = $eventData['usage'];
        }

        return new self(
            $usage['input_tokens'] ?? 0 ,
            $usage['output_tokens'] ?? 0,
        );
    }

    /**
     * @return array{prompt_tokens: int, completion_tokens: int}
     */
    public function toArray(): array
    {
        return [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
        ];
    }
}
