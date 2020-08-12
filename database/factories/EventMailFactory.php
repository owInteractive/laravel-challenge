<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EventMail;
use Faker\Generator as Faker;
use App\Event;

$factory->define(EventMail::class, function (Faker $faker) {
    return [
        'email' => $faker->safeEmail,
        'event_id' => Event::all()->random()->id
    ];
});
