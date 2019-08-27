<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\User;
use App\Models\Event;
use App\Models\Invitation;


$factory->define(Event::class, function (Faker $faker) {
    $start=$faker->dateTimeBetween($startDate = '-2 days', $endDate = '+7 days');
    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'start' => $start,
        'end' => $faker->dateTimeBetween($startDate = $start, $endDate = '+7 days'),
        'owner' => function () use ($faker){
            if( is_null( User::first()) || ($faker->boolean($chanceOfGettingTrue = 10))  )
                return factory(User::class)->create()->id;
                else
                return User::inRandomOrder()->first()->id;
       },
    ];
});


        function generate_password ($length = 6)
        {
           //$characters = '234789abcdefghjkmnpqrtuvwxyzABCDEFHJKLMNPQRTUVWXYZ';
           $characters = '234789ABCDEFHJKLMNPQRTUVWXYZ';
           $charactersLength = strlen($characters);
           $randomString = '';
           for ($i = 0; $i < $length; $i++)
           {
               $randomString .= $characters[rand(0, $charactersLength - 1)];
           }
           return $randomString;
        }

$factory->define(Invitation::class, function (Faker $faker) {

    if ($faker->boolean($chanceOfGettingTrue = 33))
        $confirm = null;
    else
        $confirm = $faker->boolean;

    return [
        'eventid' => function () use ($faker){
            if( is_null( Event::first()) || ($faker->boolean($chanceOfGettingTrue = 10))  )
                return factory(Event::class)->create()->id;
                else
                return Event::inRandomOrder()->first()->id;
       },
        'email' => $faker->safeEmail,
        'code' => generate_password(),
        'expiration' => $faker->dateTime(),
        'confirm' => $confirm,
    ];
});
