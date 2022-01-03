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
                'age' => '21',
                'gender' => '0',
                'prefecture' => '三重県',
                'bike_type' => 'スポーツ',
                'bike_name' => 'CBR',
                'engine_size' => '650cc',
                'years_of_experience' => '3',
                'through' => '1',
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/01/01 11:11:11',
                'age' => '32',
                'gender' => '1',
                'prefecture' => '東京都',
                'bike_type' => 'ネイキッド',
                'bike_name' => 'CB',
                'engine_size' => '650cc',
                'years_of_experience' => '10',
                'through' => '0',
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password'),
                'created_at' => '2021/01/01 11:11:11',
                'age' => '23',
                'gender' => '0',
                'prefecture' => '愛知県',
                'bike_type' => 'スポーツ',
                'bike_name' => 'CBR',
                'engine_size' => '650cc',
                'years_of_experience' => '3',
                'through' => '1',
            ],
        ]);
    }
}
