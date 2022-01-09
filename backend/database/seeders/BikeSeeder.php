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
                'bike_brand' => 'HONDA',
                'bike_type' => 'スポーツ',
                'bike_name' => 'CBR',
                'engine_size' => 650,
            ],
            [
                'bike_brand' => 'KAWASAKI',
                'bike_type' => 'スポーツ',
                'bike_name' => 'Ninja',
                'engine_size' => 650,
            ],
            [
                'bike_brand' => 'HONDA',
                'bike_type' => 'ネイキッド',
                'bike_name' => 'CB',
                'engine_size' => 650,
            ],
        ]);
    }
}
