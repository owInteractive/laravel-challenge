<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fabricio Junio',
            'email' => "j.fabricio6@gmail.com",
            'password' => bcrypt("123456")
        ]);
    }
}
