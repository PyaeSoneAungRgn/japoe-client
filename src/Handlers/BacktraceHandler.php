<?php

namespace PyaeSoneAung\JaPoeClient\Handlers;

use PyaeSoneAung\JaPoeClient\Contracts\BacktraceHandlerContract;
use PyaeSoneAung\JaPoeClient\DataObjects\ErrorLogDto;
use PyaeSoneAung\JaPoeClient\DataObjects\ErrorLogFrameDto;
use Spatie\Backtrace\Backtrace;
use Throwable;

class BacktraceHandler implements BacktraceHandlerContract
{
    public function parse(Throwable $throwable): ErrorLogDto
    {
        $isCli = $this->isCli();

        $backtrace = Backtrace::createForThrowable($throwable)
            ->applicationPath(base_path());
        $frames = $backtrace->frames();

        /** @var array<int, ErrorLogFrameDto> */
        $errorLogFrames = [];

        foreach ($frames as $index => $frame) {
            if ($frame->applicationFrame || $index == 0) {
                $errorLogFrames[] = new ErrorLogFrameDto(
                    snippet: $frame->getSnippet(config('japoe-client.total_line_number', 20)),
                    line_number: $frame->lineNumber,
                    file: str_replace(base_path('/'), '', $frame->file),
                    method: $frame->method,
                );
            }
        }

        return new ErrorLogDto(
            exception: $throwable::class,
            message: $throwable->getMessage(),
            host: $isCli ? null : request()->root(),
            method: $isCli ? null : request()->method(),
            path: $isCli ? null : request()->path(),
            headers: $isCli ? null : request()->headers->all(),
            query: $isCli ? null : request()->query(),
            body: $isCli ? null : request()->post(),
            controller: $isCli ? null : request()->route()->getActionName(),
            middleware: $isCli ? null : request()->route()->controllerMiddleware(),
            command: $isCli ? ($_SERVER['argv'] ?? []) : null,
            frames: $errorLogFrames,
            timezone: config('app.timezone')
        );
    }

    private function isCli(): bool
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpdbg';
    }
}
