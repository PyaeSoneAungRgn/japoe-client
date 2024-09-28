<?php

namespace PyaeSoneAung\JaPoeClient\DataObjects;

readonly class ErrorNotificationDto
{
    public function __construct(
        public string $host,
        public string $project_key,
        public ErrorLogDto $error_log
    ) {}
}
