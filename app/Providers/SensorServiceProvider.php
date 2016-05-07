<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SensorServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\Sensor\SensorRepositoryInterface', 'App\Sensor\EloquentSensorRepository');
    }

}
