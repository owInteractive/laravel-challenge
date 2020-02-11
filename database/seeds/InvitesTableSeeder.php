<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InvitesTableSeeder extends Seeder
{
    public function run()
    {

        for ($u = 1; $u < 2; $u++) {
            for ($i = 1; $i < 3; $i++) {
                DB::table('invites')->insert([
                    'event_id' =>  $i,
                    'user_id' => $u,
                    'name'    => 'Name of person ' . $i,
                    'email'    => 'Email@person'.$i,
                    'status' => 0,
                    'token' =>  Str::random(60),
                    'sended_at' => now(),
                    //'accepted_at' => null,
                    
                ]);
            }
        }
    }
}
