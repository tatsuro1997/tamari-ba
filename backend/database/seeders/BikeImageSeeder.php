<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bike_images')->insert([
            [
                'bike_id' => 1,
                'filename' => 'sample1.jpg'
            ],
            [
                'bike_id' => 2,
                'filename' => 'sample2.jpg'
            ],
            [
                'bike_id' => 3,
                'filename' => 'sample3.jpg'
            ],
        ]);
    }
}
