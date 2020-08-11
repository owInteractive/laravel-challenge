<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use App\User;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(),
        'start_at' => $faker->dateTimeBetween($startDate = '-2 days', $endDate = 'now', $timezone = null),
        'end_at' => $faker->dateTimeInInterval($startDate = 'now', $interval = '+ 5 days', $timezone = null),
        'user_id' => User::all()->random()->id
    ];
});
