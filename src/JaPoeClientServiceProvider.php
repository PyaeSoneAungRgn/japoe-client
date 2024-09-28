<?php

namespace PyaeSoneAung\JaPoeClient;

use PyaeSoneAung\JaPoeClient\Actions\CaptureErrorAction;
use PyaeSoneAung\JaPoeClient\Commands\JaPoeTestCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class JaPoeClientServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                JaPoeTestCommand::class,
            ]);
        }

        $this->app->singleton(JaPoeClient::class, JaPoeClient::class);

        $this->app->singleton(
            abstract: CaptureErrorAction::class,
            concrete: fn () => new CaptureErrorAction(
                backtraceHandler: app(config('japoe-client.trace_handler')),
                notificationHandler: app(config('japoe-client.notification_handler')),
            ),
        );
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('japoe-client')
            ->hasConfigFile();
    }
}
