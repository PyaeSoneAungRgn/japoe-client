<?php

namespace PyaeSoneAung\JaPoeClient\DataObjects;

readonly class ErrorLogDto
{
    /**
     * @param  array<int, ErrorLogFrameDto>  $frames
     */
    public function __construct(
        public string $exception,
        public string $message,
        public ?string $host,
        public ?string $method,
        public ?string $path,
        public ?array $headers,
        public ?array $query,
        public ?array $body,
        public ?string $controller,
        public ?array $middleware,
        public ?array $command,
        public array $frames,
        public string $timezone,
    ) {}

    public function toArray(): array
    {
        return [
            'exception' => $this->exception,
            'message' => $this->message,
            'host' => $this->host,
            'method' => $this->method,
            'path' => $this->path,
            'headers' => $this->headers,
            'query' => $this->query,
            'body' => $this->body,
            'controller' => $this->controller,
            'middleware' => $this->middleware,
            'command' => $this->command,
            'frames' => array_map(fn ($frame) => $frame->toArray(), $this->frames),
            'timezone' => $this->timezone,
        ];
    }
}
