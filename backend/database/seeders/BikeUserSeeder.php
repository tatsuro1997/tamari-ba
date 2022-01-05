<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Bike;
use App\Models\User;

class BikeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 9; $i++) {

            // postsとtagsテーブルのidカラムをランダムに並び替え、先頭の値を取得
            $set_bike_id = Bike::select('id')->orderByRaw("RAND()")->first()->id;
            $set_user_id = User::select('id')->orderByRaw("RAND()")->first()->id;

            // クエリビルダを利用し、上記のモデルから取得した値が、現在までの複合主キーと重複するかを確認
            $post_tag = DB::table('bike_user')
            ->where([
                ['bike_id', '=', $set_bike_id],
                ['user_id', '=', $set_user_id]
            ])->get();

            // 上記のクエリビルダで取得したコレクションが空の場合、外部キーに上記のモデルから取得した値をセット
            if ($post_tag->isEmpty()) {
                DB::table('bike_user')->insert(
                    [
                        'bike_id' => $set_bike_id,
                        'user_id' => $set_user_id,
                    ]
                );
            } else {
                $i--;
            }
        }
    }
}
