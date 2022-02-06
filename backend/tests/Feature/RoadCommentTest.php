<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Road;
use App\Models\RoadComment;
use Database\Seeders\PrefectureSeeder;

class RoadCommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    // 正常系

    public function test_ログインしていると詳細が見れる()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/roads/$road->id");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_コメントができる()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/roads/$road->id");

        $comment_data = [
            'comment' => 'コメントです',
            'road_id' => $road->id,
            'user_id' => $user->id,
        ];
        $first_path = route('user.road.comment.store', ['road' => $road->id]);

        $response = $this->post($first_path, $comment_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("roads/$road->id");
    }

    // public function test_コメント削除ができる()
    // {
    //     $user = User::factory()->create();
    //     $road = Road::factory()->create(['user_id' => $user->id]);
    //     // $comment = RoadComment::factory()->create(['user_id' => $user->id, 'road_id' => $road->id]);
    //     $response = $this->actingAs($user)
    //         ->withSession(['banned' => false])
    //         ->get("/roads/$road->id");

    //     $comment_data = [
    //         'comment' => 'コメントです',
    //         'road_id' => $road->id,
    //         'user_id' => $user->id,
    //     ];

    //     $first_path = route('user.road.comment.store', ['road' => $road->id]);
    //     $response = $this->post($first_path, $comment_data);

    //     $comment = RoadComment::latest()->first();
    //     // dd($roadcomment, $user->id, $road->id);
    //     $first_path = route('user.road.comment.destroy', ['road' => $road->id, 'comment' => $comment->id]);

    //     $response = $this->delete($first_path);

    //     $response->assertStatus(302);
    //     // エラーメッセージがないこと
    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect("roads/$road->id");
    // }


    // 異常系
    public function test_ログインしていなければコメントできない()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);

        $comment_data = [
            'comment' => 'コメントです',
            'road_id' => $road->id,
            'user_id' => $user->id,
        ];

        $first_path = route('user.road.comment.store', ['road' => $road->id]);

        $response = $this->post($first_path, $comment_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/login');
    }


    public function test_別ユーザーのコメント削除できない()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/roads/$road->id");

        $comment_data = [
            'comment' => 'コメントです',
            'road_id' => $road->id,
            'user_id' => $user->id,
        ];

        $user2 = User::factory()->create();
        $response = $this->actingAs($user2)
            ->withSession(['banned' => false])
            ->get("/roads/$road->id");

        $first_path = route('user.road.comment.store', ['road' => $road->id]);
        $response = $this->post($first_path, $comment_data);

        $comment = RoadComment::latest()->first();
        $first_path = route('user.road.comment.destroy', ['road' => $road->id, 'comment' => $comment->id]);

        $response = $this->delete($first_path);

        $response->assertStatus(404);
    }
}
