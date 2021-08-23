<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('menuActive',function($expression) {
            list($route, $class) = explode(', ', $expression);
            return "{{ request()->is({$route}) ? {$class} : '' }}";
        });

        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
