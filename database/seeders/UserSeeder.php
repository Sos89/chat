<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                    'name' => 'Admin',
                    'surname' => 'Admin',
                    'gender' => 'male',
                    'email' => 'admin@mail.ru',
                    'role' => '1',
                    'password' => Hash::make('11111111')
                ]);
        DB::table('users')->insert([
                    'name' => 'User',
                    'surname' => 'User',
                    'gender' => 'male',
                    'email' => 'user@mail.ru',
                    'role' => '0',
                    'password' => Hash::make('11111111'),
                ]);
    }
}
