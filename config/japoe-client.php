<?php

return [
    /**
     * Enable JaPoe service
     */
    'enable' => env('JAPOE_ENABLE', false),

    /**
     * JaPoe host
     */
    'host' => env('JAPOE_HOST'),

    /**
     * JaPoe project key
     */
    'project_key' => env('JAPOE_KEY'),

    /**
     * Timeout for http client
     */
    'timeout' => 3,

    /**
     * Total line number for snippet
     */
    'total_line_number' => 20,

    /**
     * Backtrace handler class
     */
    'trace_handler' => PyaeSoneAung\JaPoeClient\Handlers\BacktraceHandler::class,

    /**
     * Notification handler Class
     */
    'notification_handler' => PyaeSoneAung\JaPoeClient\Handlers\NotificationHandler::class,
];
