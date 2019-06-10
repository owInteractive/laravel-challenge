<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator;

$factory->define(Event::class, function (Faker\Generator $faker) {

    $date_start = date('Y-m-d');
    $date_end = $faker->dateTimeBetween($date_start, strtotime('+6 days'));

    return [
        'title' =>  $faker->sentence(3),
        'description' => $faker->paragraph,
        'date_start' => $date_start,
        'date_end' => $date_end
    ];
});