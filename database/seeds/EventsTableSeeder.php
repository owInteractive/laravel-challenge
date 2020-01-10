<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'title' => 'Laravel Keynote',
            'description' => 'Laravel Keynote',
            'start_at' => '2020-01-10 02:06:18.000',
            'end_at' => '2020-01-13 18:00:00.000',
            'user_id' => 1,
        ]);
    }
}
