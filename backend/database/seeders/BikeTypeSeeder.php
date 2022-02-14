<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makers = [
            ['id' => 1, 'name' => 'スーパースポーツ'],
            ['id' => 2, 'name' => 'スポーツツアラー'],
            ['id' => 3, 'name' => 'ツアラー'],
            ['id' => 4, 'name' => 'ネイキッド'],
            ['id' => 5, 'name' => 'ストリートファイター'],
            ['id' => 6, 'name' => 'オフロード'],
            ['id' => 7, 'name' => 'スーパーモタード'],
            ['id' => 8, 'name' => 'アメリカン'],
            ['id' => 9, 'name' => 'クラシック'],
            ['id' => 10, 'name' => 'アドベンチャー'],
            ['id' => 11, 'name' => 'ストリート'],
            ['id' => 12, 'name' => 'スクランブラー'],
            ['id' => 13, 'name' => 'カフェレーサー'],
            ['id' => 14, 'name' => 'ミニバイク'],
            ['id' => 15, 'name' => 'スクーター'],
            ['id' => 16, 'name' => 'その他'],
        ];
        DB::table('types')->insert($makers);
    }
}
