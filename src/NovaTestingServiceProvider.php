<?php

namespace Esign\NovaTesting;

use Illuminate\Support\ServiceProvider;

class NovaTestingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('nova-testing.php')], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'nova-testing');

        $this->app->singleton('nova-testing', function () {
            return new NovaTesting;
        });
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../config/nova-testing.php';
    }
}
