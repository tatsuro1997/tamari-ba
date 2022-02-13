<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bikes')->insert([
            [
                'maker_id' => 'HONDA',
                'type_id' => 'スポーツ',
                'name' => 'CBR',
                'engine_size' => 650,
            ],
            [
                'maker_id' => 'KAWASAKI',
                'type_id' => 'スポーツ',
                'name' => 'Ninja',
                'engine_size' => 650,
            ],
            [
                'maker_id' => 'HONDA',
                'type_id' => 'ネイキッド',
                'name' => 'CB',
                'engine_size' => 650,
            ],
        ]);
    }
}
