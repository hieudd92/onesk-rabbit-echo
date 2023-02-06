<?php

namespace Onesk\RabbitEcho;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/rabbit-echo.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('rabbit-echo.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'rabbit-echo'
        );

        $this->app->bind('rabbit-echo', function () {
            return new RabbitEcho();
        });
    }
}
