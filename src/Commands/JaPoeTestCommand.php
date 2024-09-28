<?php

namespace PyaeSoneAung\JaPoeClient\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;
use PyaeSoneAung\JaPoeClient\Actions\CaptureErrorAction;
use Throwable;

class JaPoeTestCommand extends Command
{
    public $signature = 'japoe:test';

    public $description = 'JaPoe test command';

    public function handle(): int
    {
        $enable = filter_var(config('japoe-client.enable'), FILTER_VALIDATE_BOOLEAN);
        $host = config('japoe-client.host');
        $projectKey = config('japoe-client.project_key');

        $this->table(
            ['.env', 'Result'],
            [
                ['JAPOE_ENABLE', $enable ? '✅' : '❌'],
                ['JAPOE_HOST', $host ? '✅' : '❌'],
                ['JAPOE_KEY', $projectKey ? '✅' : '❌'],
            ]
        );

        if ($enable && $host && $projectKey) {
            $testException = new Exception('This is JaPoe test error!');
            try {
                $result = app(CaptureErrorAction::class)
                    ->handle($testException);
                if ($result instanceof Response) {
                    if ($result->ok()) {
                        $this->info('✅ Success!');
                    } else {
                        $this->error('Error: '.($result->json('message') ?: $result->body()));
                    }
                } elseif ($result instanceof Throwable) {
                    $this->error('Error: '.$result->getMessage());
                }
            } catch (Throwable $e) {
                $this->error('Error: '.$e->getMessage());
            }
        }

        return self::SUCCESS;
    }
}
