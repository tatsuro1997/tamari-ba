<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 21; $i++) {
            DB::table('board_users')->insert([
                    'board_id' => $i,
                    'user_id' => 1,
                ],
            );
        }

    }
}
