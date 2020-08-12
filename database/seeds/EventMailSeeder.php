<?php

use Illuminate\Database\Seeder;
use App\EventMail;

class EventMailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EventMail::class,50)->create();
    }
}
