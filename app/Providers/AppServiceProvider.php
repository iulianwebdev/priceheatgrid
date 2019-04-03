<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->app['validator']->extend('arrayofints', function ($attribute, $value, $parameters) {
            foreach ($value as $v) {
                foreach ($v as $number) {
                    if (!is_int($number)) {
                        return false;
                    }
                }
            }
            return true;
        });
    }
}
