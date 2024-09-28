<?php

namespace PyaeSoneAung\JaPoeClient\Contracts;

use Illuminate\Http\Client\Response;
use PyaeSoneAung\JaPoeClient\DataObjects\ErrorNotificationDto;

interface NotificationHandlerContract
{
    public function notify(ErrorNotificationDto $errorNotificationDto): Response;
}
