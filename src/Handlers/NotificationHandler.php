<?php

namespace PyaeSoneAung\JaPoeClient\Handlers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use PyaeSoneAung\JaPoeClient\Contracts\NotificationHandlerContract;
use PyaeSoneAung\JaPoeClient\DataObjects\ErrorNotificationDto;

class NotificationHandler implements NotificationHandlerContract
{
    public function notify(ErrorNotificationDto $errorNotificationDto): Response
    {
        return Http::baseUrl($errorNotificationDto->host)
            ->acceptJson()
            ->timeout(config('japoe-client.timeout', 3))
            ->withOptions([
                'verify' => false,
            ])
            ->post('/api/capture-error', [
                'project_key' => $errorNotificationDto->project_key,
                ...$errorNotificationDto->error_log->toArray(),
            ]);
    }
}
