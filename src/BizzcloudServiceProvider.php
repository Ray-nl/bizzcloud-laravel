<?php

namespace Raynl\Bizzcloud;

use Statamic\Providers\AddonServiceProvider;

class BizzcloudServiceProvider extends AddonServiceProvider
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
        $this->app->register(\Ripcord\Providers\Laravel\ServiceProvider::class);
    }
}
