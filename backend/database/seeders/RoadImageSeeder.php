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
                'filename' => 'sample3.jpg'
            ],
            [
                'road_id' => 3,
                'filename' => 'sample4.jpg'
            ],
            [
                'road_id' => 4,
                'filename' => 'sample4.jpg'
            ],
            [
                'road_id' => 5,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 6,
                'filename' => 'sample2.jpg'
            ],
            [
                'road_id' => 7,
                'filename' => 'sample3.jpg'
            ],
            [
                'road_id' => 8,
                'filename' => 'sample4.jpg'
            ],
            [
                'road_id' => 9,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 10,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 11,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 12,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 13,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 14,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 15,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 16,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 17,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 18,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 19,
                'filename' => 'sample1.jpg'
            ],
            [
                'road_id' => 20,
                'filename' => 'sample1.jpg'
            ],
        ]);
    }
}
