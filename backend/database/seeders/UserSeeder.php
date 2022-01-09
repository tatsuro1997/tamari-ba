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
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/01/01 11:11:11',
                'age' => 21,
                'gender' => 0,
                'prefecture_id' => 1,
                'years_of_experience' => 3,
                'through' => true,
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/01/01 11:11:11',
                'age' => 32,
                'gender' => 1,
                'prefecture_id' => 28,
                'years_of_experience' => 10,
                'through' => false,
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/01/01 11:11:11',
                'age' => 23,
                'gender' => 0,
                'prefecture_id' => 32,
                'years_of_experience' => 3,
                'through' => true,
            ],
        ]);
    }
}
