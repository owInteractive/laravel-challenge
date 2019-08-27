<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Event;
use App\Models\Invitation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 10)->create()
            ->each(function($user) {
                factory(Event::class, 3)->create([
                    'owner' => $user['id']
                ])
                    ->each(function($event) {
                        factory(Invitation::class, 5)->create([
                            'eventid' => $event['id']
                        ]);
                    });
            });
    }
}
