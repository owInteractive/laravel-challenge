<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 8; $i++) {
            DB::table('events')->insert([
                'user_id' => 1,
                'title' => 'Event Test ' . $i,
                'description' => 'Event Test Description ' . $i,
                'start_at' => now(),
                'end_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                
            ]);
        }
    }
}