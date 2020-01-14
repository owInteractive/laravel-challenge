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
        //
        \Illuminate\Support\Facades\Schema::defaultStringLength(191); // Corrige erro ao dar o comando "php artisan migrate" em BD com mysql com versao menor que 5.7
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
