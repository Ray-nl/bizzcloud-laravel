<?php

namespace Raynl\Bizzcloud;

use Illuminate\Support\ServiceProvider;

class BizzcloudServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('bizzcloud.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'bizzcloud');
    }
}
