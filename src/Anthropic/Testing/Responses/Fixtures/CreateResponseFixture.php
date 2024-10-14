<?php

namespace Ahmadrosid\Laravel\Anthropic\Testing\Responses\Fixtures;

class CreateResponseFixture
{

    const ATTRIBUTES = [
        "id" => "msg_01HUfqJwPirt4BEu36YtKnAw",
        "type" => "message",
        "role" => "assistant",
        "model" => "claude-3-5-sonnet-20240620",
        "content" => [
            [
                "type" => "text",
                "text" => "Hello! How can I assist you today? Feel free to ask any questions or let me know if there's a topic you'd like to discuss."
            ]
        ],
        "stop_reason" => "end_turn",
        "stop_sequence" => null,
        "usage" => [
            "input_tokens" => 14,
            "output_tokens" => 33
        ]
    ];
}
