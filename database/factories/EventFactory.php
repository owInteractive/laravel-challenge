<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;
use App\User;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(),
        'start_date' =>  $faker->date($format = 'Y-m-d'),
        'start_time' => $faker->time($format = 'H:i:s'),
        'end_date' => $faker->date($format = 'Y-m-d'),
        'end_time' => $faker->time($format = 'H:i:s'),
        'user_id' => User::all()->random()->id
    ];
});
