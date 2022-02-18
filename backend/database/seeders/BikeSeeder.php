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
                'title' => 'CBR650R納車しました!',
                'maker_id' => 1,
                'type_id' => 2,
                'name' => 'CBR',
                'engine_size' => 650,
                'description' => '横浜で納車して4時間かけて帰ってくるのが大変だった〜',
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                'title' => '初ツーリング',
                'maker_id' => 1,
                'type_id' => 2,
                'name' => 'CBR',
                'engine_size' => 650,
                'description' => '納車日にそのまま芦ノ湖へツーリング',
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                'title' => 'ガソスタ映え？',
                'maker_id' => 1,
                'type_id' => 2,
                'name' => 'CBR',
                'engine_size' => 650,
                'description' => '納車して地元に4時間かけて帰還。ナビに使っていたiPhoneのカメラがバグりだして、萎えました。',
                'user_id' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
