<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('sub_arrays_of_ints', function ($attribute, $value, $parameters) {
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
