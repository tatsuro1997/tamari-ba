<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roads')->insert([
            [
                'title' => 'タイトル1',
                'latitude' => 35.6804,
                'longitude' => 139.769017,
                'description' => 'ここに説明が入ります。ここに説明が入ります。ここに説明が入ります。',
                'user_id' => 1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'title' => 'タイトル2',
                'latitude' => 35.6804,
                'longitude' => 139.769017,
                'description' => 'ここに説明が入ります。ここに説明が入ります。ここに説明が入ります。',
                'user_id' => 1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'title' => 'タイトル3',
                'latitude' => 35.6804,
                'longitude' => 139.769017,
                'description' => 'ここに説明が入ります。ここに説明が入ります。ここに説明が入ります。',
                'user_id' => 1,
                'created_at' => '2021/01/01 11:11:11',
            ],
            [
                'title' => 'タイトル4',
                'latitude' => 35.6804,
                'longitude' => 139.769017,
                'description' => 'ここに説明が入ります。ここに説明が入ります。ここに説明が入ります。',
                'user_id' => 1,
                'created_at' => '2021/01/01 11:11:11',
            ],

        ]);
    }
}
