<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Bike;
use Database\Seeders\PrefectureSeeder;

class BikeLikeTest extends TestCase
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
            ->get("/bikes");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_いいねができる()
    {
        $user = User::factory()->create();
        $bike = Bike::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/bikes/$bike->id");

        $first_path = route('user.bike.like');

        $response = $this->postJson($first_path, ['bike_id' => $bike->id]);

        $response->assertStatus(200);
        // いいねが保存されている
        $this->assertDatabaseCount('bike_likes', 1);
    }

    public function test_二度いいねをすると取り消すことができる()
    {
        $user = User::factory()->create();
        $bike = Bike::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/bikes/$bike->id");

        $first_path = route('user.bike.like');

        // ２回いいねを押すと削除
        $i = 0;
        while ($i < 2) {
            $response = $this->postJson($first_path, ['bike_id' => $bike->id]);
            $i++;
        }

        $response->assertStatus(200);
        // いいねが保存されている
        $this->assertDatabaseCount('bike_likes', 0);
    }
}
