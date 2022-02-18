<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('road_images')->insert([
            [
                'road_id' => 1,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 2,
                'filename' => 'sample2.jpg'
            ],
            [
                'road_id' => 3,
                'filename' => 'sample3.jpg'
            ],
        ]);
    }
}
