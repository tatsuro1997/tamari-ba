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
                'name' => 'CBRer',
                'email' => 'seed@sample.com',
                'password' => 'seedsample',
                'created_at' => now(),
                'age' => 24,
                'gender' => 0,
                'prefecture_id' => 24,
                'years_of_experience' => 3,
                'through' => true,
            ],
        ]);
    }
}
