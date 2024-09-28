<?php

namespace PyaeSoneAung\JaPoeClient\DataObjects;

readonly class ErrorLogFrameDto
{
    public function __construct(
        public array $snippet,
        public int $line_number,
        public string $file,
        public ?string $method = null
    ) {}

    public function toArray(): array
    {
        return [
            'snippet' => $this->snippet,
            'line_number' => $this->line_number,
            'file' => $this->file,
            'method' => $this->method,
        ];
    }
}
