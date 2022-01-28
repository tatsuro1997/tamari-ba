<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'ライダーズカフェ',
                'slug' => 'rcafe',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '峠',
                'slug' => 'touge',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'スカイライン',
                'slug' => 'skyline',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $faker = Faker::create();
        for ($i = 1; $i <= 20; $i++) {
            DB::table('road_tag')->insert([
                'road_id' => $i,
                'tag_id' => $faker->numberBetween(1, 3)
            ]);
        }
    }
}
