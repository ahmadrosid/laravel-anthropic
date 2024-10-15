<?php

namespace Ahmadrosid\Laravel\Anthropic\Resources;

class Model
{
    public function all(): array
    {
        return [
            [
                'id' => 'claude-3-haiku-20240307',
                'label' =>'Claude 3 Haiku',
            ],
            [
                'id' => 'claude-3-sonnet-20240229',
                'label' =>'Claude 3 Sonnet',
            ],
            [
                'id' => 'claude-3-opus-20240229',
                'label' =>'Claude 3 Opus',
            ],
            [
                'id' => 'claude-3-5-sonnet-20240620',
                'label' =>'Claude 3.5 Sonnet',
            ],
        ];
    }
}