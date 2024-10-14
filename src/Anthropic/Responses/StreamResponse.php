<?php

namespace Ahmadrosid\Laravel\Anthropic\Responses;

use IteratorAggregate;
use Generator;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;

class StreamResponse implements IteratorAggregate
{
    public function __construct(
        private readonly ResponseInterface $response
    ) {
    }

    private function readLine(StreamInterface $stream): string
    {
        $buffer = '';

        while (!$stream->eof()) {
            if ('' === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;
            if ($byte === "\n") {
                break;
            }
        }

        return $buffer;
    }

    public function getIterator(): Generator
    {
        $body = $this->response->getBody();

        while (!$body->eof()) {
            $line = $this->readLine($body);

            if (!str_starts_with($line, 'data:')) {
                continue;
            }

            $data = trim(substr($line, strlen('data:')));

            $response = json_decode($data, true, flags: JSON_THROW_ON_ERROR);

            // Have not confirmed the error can be sent in data
            if (isset($response['error'])) {
                logger('Anthropic error: ' . json_encode($response['error']));
                $errorMessage = $response['error']['message'] ?? json_encode($response['error']);
                if (is_array($errorMessage)) {
                    $errorMessage = implode(', ', $errorMessage);
                }
                throw new \Exception($errorMessage);
            }

            yield CreateStreamedResponse::from($response);
        }
    }
}
