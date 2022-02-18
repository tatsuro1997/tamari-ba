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
                'title' => '芦ノ湖スカイライン',
                'latitude' => 35.2107548,
                'longitude' => 138.9876645,
                'description' => '二代目納車日に初めて訪れたので、関東のスーパーバイクが怖かった。そこでちゃっかりパニさんと写真を収めました。道は有料道路ということもあり、非常に綺麗で走りやすい印象。途中途中に写真スポットがあるので、途中下車しながらゆっくり山頂を目指しました。（納車後で怖かった）',
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                'title' => '鈴鹿スカイライン',
                'latitude' => 35.00469071715458,
                'longitude' => 136.3959503173828,
                'description' => 'スカイラインと聞くと有料道路が目立ちますが、鈴鹿スカイラインは無料です。そのため、他と比べると道はあれていたり、山頂に行っても特に何かがあるわけではないです。鈴スカは三重と滋賀を結ぶ道です。三重側と滋賀側にまたがる鈴スカですが、三重側は勾配がきついことや単調な道なのでライダーにとってはあまり面白くありません。攻めたいライダーは滋賀側に行くことがオススメです!',
                'user_id' => 1,
                'created_at' => now(),
            ],
            [
                'title' => '伊勢志摩スカイライン',
                'latitude' => 34.4594372960553,
                'longitude' => 136.7760944366455,
                'description' => '晴れた日には伊勢志摩の絶景をバックに愛車の写真を撮ることが可能です。有料道路なので道はきれいですし、景色も最高です。訪れた際は景色に気を取られて反対車線に飛び出さないようにご注意ください。',
                'user_id' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
