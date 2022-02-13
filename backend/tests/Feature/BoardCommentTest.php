<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Board;
use App\Models\BoardComment;
use Database\Seeders\PrefectureSeeder;

class BoardCommentTest extends TestCase
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
        $board = Board::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/boards/$board->id");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_コメントができる()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/boards/$board->id");

        $comment_data = [
            'comment' => 'コメントです',
            'board_id' => $board->id,
            'user_id' => $user->id,
        ];
        $first_path = route('user.board.comment.store', ['board' => $board->id]);

        $response = $this->post($first_path, $comment_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("boards/$board->id");
    }

    // public function test_コメント削除ができる()
    // {
    //     $user = User::factory()->create();
    //     $board = Board::factory()->create(['user_id' => $user->id]);
    //     // $comment = BoardComment::factory()->create(['user_id' => $user->id, 'road_id' => $board->id]);
    //     $response = $this->actingAs($user)
    //         ->withSession(['banned' => false])
    //         ->get("/boards/$board->id");

    //     $comment_data = [
    //         'comment' => 'コメントです',
    //         'board_id' => $board->id,
    //         'user_id' => $user->id,
    //     ];

    //     $first_path = route('user.board.comment.store', ['board' => $board->id]);
    //     $response = $this->post($first_path, $comment_data);

    //     $comment = BoardComment::latest()->first();
    //     // dd($roadcomment, $user->id, $board->id);
    //     $first_path = route('user.board.comment.destroy', ['board' => $board->id, 'comment' => $comment->id]);

    //     $response = $this->delete($first_path);

    //     $response->assertStatus(302);
    //     // エラーメッセージがないこと
    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect("boards/$board->id");
    // }


    // 異常系
    public function test_ログインしていなければコメントできない()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create(['user_id' => $user->id]);

        $comment_data = [
            'comment' => 'コメントです',
            'road_id' => $board->id,
            'user_id' => $user->id,
        ];

        $first_path = route('user.board.comment.store', ['board' => $board->id]);

        $response = $this->post($first_path, $comment_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/login');
    }


    public function test_別ユーザーのコメント削除できない()
    {
        $user = User::factory()->create();
        $board = Board::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/boards/$board->id");

        $comment_data = [
            'comment' => 'コメントです',
            'board_id' => $board->id,
            'user_id' => $user->id,
        ];

        $user2 = User::factory()->create();
        $response = $this->actingAs($user2)
            ->withSession(['banned' => false])
            ->get("/boards/$board->id");

        $first_path = route('user.board.comment.store', ['board' => $board->id]);
        $response = $this->post($first_path, $comment_data);

        $comment = BoardComment::latest()->first();
        $first_path = route('user.board.comment.destroy', ['board' => $board->id, 'comment' => $comment->id]);

        $response = $this->delete($first_path);

        $response->assertStatus(404);
    }
}
