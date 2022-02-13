<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Road;
use Database\Seeders\PrefectureSeeder;

class RoadLikeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    public function test_ログインしていると一覧が見れる()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/roads");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_いいねができる()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/roads/$road->id");

        $first_path = route('user.road.like');

        $response = $this->postJson($first_path, ['road_id' => $road->id]);

        $response->assertStatus(200);
        // いいねが保存されている
        $this->assertDatabaseCount('road_likes', 1);
    }

    public function test_二度いいねをすると取り消すことができる()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/roads/$road->id");

        $first_path = route('user.road.like');

        // ２回いいねを押すと削除
        $i = 0;
        while ($i < 2) {
            $response = $this->postJson($first_path, ['road_id' => $road->id]);
            $i++;
        }

        $response->assertStatus(200);
        // いいねが保存されている
        $this->assertDatabaseCount('road_likes', 0);
    }
}
