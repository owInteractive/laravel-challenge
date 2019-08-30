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
                factory(Event::class, 5)->create([
                    'owner' => $user['id']
                ])
                    ->each(function($event) {
                        factory(Invitation::class, 6)->create([
                            'eventid' => $event['id']
                        ]);
                    });
            });
        User::whereId('1')->update(['email' => 'teste@teste.com','password' => bcrypt('12345678'), 'updated_at' => date('Y-m-d H:i:s'), ]);
    }
}
