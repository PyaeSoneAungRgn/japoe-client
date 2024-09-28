<?php

namespace PyaeSoneAung\JaPoeClient;

use Illuminate\Foundation\Configuration\Exceptions;
use PyaeSoneAung\JaPoeClient\Actions\CaptureErrorAction;
use Throwable;

readonly class JaPoeClient
{
    public function handles(Exceptions $exceptions)
    {
        $exceptions->reportable(static function (Throwable $exception) {
            app(CaptureErrorAction::class)
                ->handle($exception);
        });
    }
}
