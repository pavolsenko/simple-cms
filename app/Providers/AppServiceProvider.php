<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->share('meta_author', \Config::get('app.meta_author'));
        view()->share('meta_description', \Config::get('app.meta_description'));
        view()->share('meta_title', \Config::get('app.meta_title'));
        view()->share('meta_keywords', \Config::get('app.meta_keywords'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
