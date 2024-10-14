# Laravel Anthropic

Unofficial Anthropic AI client for laravel.

## Installation

```bash
composer require ahmarosid/laravel-anthropic
```

## Env

Add an environment variable with the key `ANTHROPIC_API_KEY`.

```bash
ANTHROPIC_API_KEY=sk-...
```

## Usage

Chat without streaming.
```php
use Ahmadrosid\Laravel\Anthropic\AnthropicAI;

$response = AnthropicAI::chat()->create([
    'model' => 'claude-3-opus-20240229',
    'temperature' => 0,
    'max_tokens' => 1024,
    'system' => 'You are a helpfull assistant',
    'messages' => [
        [
            'role' => 'user',
            'content' => 'Hello, how are you?'
        ]
    ],
]);
```

Chat with streaming.
```php
use Ahmadrosid\Laravel\Anthropic\AnthropicAI;

$response = AnthropicAI::chat()->createStreamed([
    'model' => 'claude-3-opus-20240229',
    'temperature' => 0,
    'max_tokens' => 1024,
    'system' => 'You are a helpfull assistant',
    'messages' => [
        [
            'role' => 'user',
            'content' => 'Hello, how are you?'
        ]
    ],
]);

foreach ($response as $block) {
    foreach ($block->choices as $choice) {
        if ($choice->delta) {
            echo($choice->delta->content);
        }
    }
}
```

## Testing

You can mock the response from anthropic.

```php
AnthropicAI::fake([
    \Ahmarosid\Laravel\Anthropic\Responses\CreateResponse::fake([
        'role' => 'assistant',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example mock response',
            ]
        ],
        'usage' => [
            'input_tokens' => 10,
            'output_tokens' => 10
        ]
    ])
]);
```
