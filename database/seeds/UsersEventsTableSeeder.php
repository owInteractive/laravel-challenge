<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {

        DB::transaction(function () {

            $faker = Faker\Factory::create();

            $userId = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('password'),
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);

            $eventId = DB::table('events')->insertGetId([
                'title' => $faker->sentence,
                'description' => $faker->text,
                'start_at' => Carbon::today(),
                'end_at' => Carbon::today()->addDays(7),
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);

            DB::table('event_user')->insert([
                'event_id' => $eventId,
                'user_id' => $userId,
                'owner' => true,
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);

        });

    }
}
