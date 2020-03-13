<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use App\Observers\EventObserver;
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
        # observers
        User::observe(UserObserver::class);
        Event::observe(EventObserver::class);

        # local
        Carbon::setLocale('pt-br');
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
