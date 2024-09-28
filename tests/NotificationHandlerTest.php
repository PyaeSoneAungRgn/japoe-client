<?php

use Illuminate\Support\Facades\Http;
use PyaeSoneAung\JaPoeClient\DataObjects\ErrorNotificationDto;
use PyaeSoneAung\JaPoeClient\Handlers\BacktraceHandler;
use PyaeSoneAung\JaPoeClient\Handlers\NotificationHandler;

it('can send notification', function () {
    Http::fake();

    $error = new Exception('Example error');
    $errorLogDto = app(BacktraceHandler::class)->parse($error);

    $notificationHandler = app(NotificationHandler::class)->notify(new ErrorNotificationDto(
        host: config('japoe-client.host'),
        project_key: config('japoe-client.project_key'),
        error_log: $errorLogDto
    ));

    expect($notificationHandler->ok())->toBe(true);
});
