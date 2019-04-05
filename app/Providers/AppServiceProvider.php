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
        /** Add Filesystem support */
        $this->app->configure('filesystems');

        $this->app->singleton(
            Illuminate\Contracts\Filesystem\Factory::class,
            function ($app) {
                return new Illuminate\Filesystem\FilesystemManager($app);
            }
        );
    }

    public function boot()
    {
        $ruleName = 'sub_arrays_of_three_ints';
        //split into 2 rules
        Validator::extend($ruleName, function ($attribute, $value, $parameters) {
            foreach ($value as $v) {
                if (count($v) !== 3) {
                    return false;
                }
                foreach ($v as $number) {
                    if (!is_int($number)) {
                        return false;
                    }
                }
            }
            return true;
        });

        Validator::replacer($ruleName, function ($message, $attribute, $rule, $parameters) {
            return 'Data should be formated by 3 ints on a line.';
        });
    }
}
