<?php

use PyaeSoneAung\JaPoeClient\DataObjects\ErrorLogDto;
use PyaeSoneAung\JaPoeClient\Handlers\BacktraceHandler;

it('can parse exception', function () {
    $error = new Exception('Example error');
    expect(app(BacktraceHandler::class)->parse($error))->toBeInstanceOf(ErrorLogDto::class);
});
