<?php

namespace PyaeSoneAung\JaPoeClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PyaeSoneAung\JaPoeClient\JaPoeClient
 */
class JaPoeClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PyaeSoneAung\JaPoeClient\JaPoeClient::class;
    }
}
