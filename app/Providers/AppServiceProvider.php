<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
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
        //
        User::observe(UserObserver::class);

        //
        Carbon::setLocale('pt-br');

        Validator::extend('check_date', function ($attribute, $value, $parameters, $validator) {
            list($operator, $column) = $parameters;

            $date_compare = $validator->getData()[$column];

            if ($operator === 'gt') {
                return $value > $date_compare;
            }

            return $value < $date_compare;
        });
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
