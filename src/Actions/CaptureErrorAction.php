<?php

namespace PyaeSoneAung\JaPoeClient\Actions;

use PyaeSoneAung\JaPoeClient\Contracts\BacktraceHandlerContract;
use PyaeSoneAung\JaPoeClient\Contracts\NotificationHandlerContract;
use PyaeSoneAung\JaPoeClient\DataObjects\ErrorNotificationDto;
use Throwable;

class CaptureErrorAction
{
    public function __construct(
        private BacktraceHandlerContract $backtraceHandler,
        private NotificationHandlerContract $notificationHandler,
    ) {}

    public function handle(Throwable $throwable)
    {
        try {
            $enable = filter_var(config('japoe-client.enable'), FILTER_VALIDATE_BOOLEAN);
            $host = config('japoe-client.host');
            $projectKey = config('japoe-client.project_key');
            if ($enable && $host && $projectKey) {
                $errorLog = $this->backtraceHandler->parse($throwable);

                return $this->notificationHandler->notify(new ErrorNotificationDto(
                    project_key: $projectKey,
                    host: $host,
                    error_log: $errorLog
                ));
            }
        } catch (Throwable $e) {
            return $e;
        }

        return null;
    }
}
