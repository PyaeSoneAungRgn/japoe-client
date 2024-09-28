<?php

namespace PyaeSoneAung\JaPoeClient\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use PyaeSoneAung\JaPoeClient\JaPoeClientServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            JaPoeClientServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('japoe-client.enable', true);
        config()->set('japoe-client.host', 'https://your.domain.com');
        config()->set('japoe-client.project_key', 'your-project-key');
    }
}
