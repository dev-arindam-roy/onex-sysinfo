<?php

namespace Onex\Sysinfo;

use Illuminate\Support\ServiceProvider;
use Onex\Sysinfo\Sysinfo\SysinfoClass;

class OnexSysinfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind('sysinfoclass',function(){
            return new SysinfoClass();
        });

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'sysinfo');

        $this->mergeConfigFrom(
            __DIR__ . '/config/onex-sysinfo.php', 'sysinfo'
        );

        $this->publishes([
            __DIR__ . '/config/onex-sysinfo.php' => config_path('onex-sysinfo.php')
        ]);

        //php artisan vendor:publish --provider="Onex\Sysinfo\OnexSysinfoServiceProvider" --force
    }
}