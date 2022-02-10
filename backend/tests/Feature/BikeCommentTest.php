<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Bike;
use App\Models\BikeComment;
use Database\Seeders\PrefectureSeeder;

class BikeCommentTest extends TestCase
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
        $bike = Bike::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/bikes/$bike->id");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_コメントができる()
    {
        $user = User::factory()->create();
        $bike = Bike::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/bikes/$bike->id");

        $comment_data = [
            'comment' => 'コメントです',
            'bike_id' => $bike->id,
            'user_id' => $user->id,
        ];
        $first_path = route('user.bike.comment.store', ['bike' => $bike->id]);

        $response = $this->post($first_path, $comment_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("bikes/$bike->id");
    }

    // public function test_コメント削除ができる()
    // {
    //     $user = User::factory()->create();
    //     $bike = Bike::factory()->create(['user_id' => $user->id]);
    //     // $comment = bikeComment::factory()->create(['user_id' => $user->id, 'bike_id' => $bike->id]);
    //     $response = $this->actingAs($user)
    //         ->withSession(['banned' => false])
    //         ->get("/bikes/$bike->id");

    //     $comment_data = [
    //         'comment' => 'コメントです',
    //         'bike_id' => $bike->id,
    //         'user_id' => $user->id,
    //     ];

    //     $first_path = route('user.bike.comment.store', ['bike' => $bike->id]);
    //     $response = $this->post($first_path, $comment_data);

    //     $comment = bikeComment::latest()->first();
    //     // dd($bikecomment, $user->id, $bike->id);
    //     $first_path = route('user.bike.comment.destroy', ['bike' => $bike->id, 'comment' => $comment->id]);

    //     $response = $this->delete($first_path);

    //     $response->assertStatus(302);
    //     // エラーメッセージがないこと
    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect("bikes/$bike->id");
    // }


    // 異常系
    public function test_ログインしていなければコメントできない()
    {
        $user = User::factory()->create();
        $bike = Bike::factory()->create(['user_id' => $user->id]);

        $comment_data = [
            'comment' => 'コメントです',
            'bike_id' => $bike->id,
            'user_id' => $user->id,
        ];

        $first_path = route('user.bike.comment.store', ['bike' => $bike->id]);

        $response = $this->post($first_path, $comment_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/login');
    }


    public function test_別ユーザーのコメント削除できない()
    {
        $user = User::factory()->create();
        $bike = Bike::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/bikes/$bike->id");

        $comment_data = [
            'comment' => 'コメントです',
            'bike_id' => $bike->id,
            'user_id' => $user->id,
        ];

        $user2 = User::factory()->create();
        $response = $this->actingAs($user2)
            ->withSession(['banned' => false])
            ->get("/bikes/$bike->id");

        $first_path = route('user.bike.comment.store', ['bike' => $bike->id]);
        $response = $this->post($first_path, $comment_data);

        $comment = bikeComment::latest()->first();
        $first_path = route('user.bike.comment.destroy', ['bike' => $bike->id, 'comment' => $comment->id]);

        $response = $this->delete($first_path);

        $response->assertStatus(404);
    }
}
