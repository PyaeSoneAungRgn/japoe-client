<?php

namespace PyaeSoneAung\JaPoeClient\Contracts;

use PyaeSoneAung\JaPoeClient\DataObjects\ErrorLogDto;
use Throwable;

interface BacktraceHandlerContract
{
    public function parse(Throwable $throwable): ErrorLogDto;
}
