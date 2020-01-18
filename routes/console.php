<?php

use App\Event;
use App\Models\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('users:count', function () {
    $this->info(User::count() . ' registered users.');
})->describe('Get number of Users');

Artisan::command('users:list', function () {

    $users = User::all();
    $users->each(function ($user, $key) {
        $this->info(sprintf('%s (%s)', $user->name, $user->email));
    });

})->describe('List Users');

Artisan::command('events:count', function () {
    $this->info(Event::count() . ' events created.');
})->describe('Get number of created events.');
