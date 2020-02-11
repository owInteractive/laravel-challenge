<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => 'User Test ' . $i,
                'email' => 'user' . $i . '@test.com',
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
