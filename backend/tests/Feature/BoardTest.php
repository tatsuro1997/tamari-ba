<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Board;
use Illuminate\Http\UploadedFile;

class BoardTest extends TestCase
{
    // 正常系

    public function test_ログインしていると一覧が見れる()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/boards');

        $response->assertStatus(200);
    }

    public function test_新規投稿()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');

        $response = $this->post($first_path, $board_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/boards');
    }

    public function test_詳細()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards/1");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_編集()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        // 更新前
        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');
        $response = $this->post($first_path, $board_data);


        // 更新
        $board_data = [
            'title' => 'Update Board',
            'date' => '2022-03-26 23:33:00',
            'location' => '三重',
            'destination' => '東京',
            'description' => '説明が入ります説明が入ります',
            'deadline' => false,
            'prefecture_id' => 2,
            'images' => $read_temp_path,
        ];

        // 最新の投稿を指定
        $board = Board::latest()->first();
        $first_path = route('user.boards.update', ['board' => $board->id]);

        $response = $this->put($first_path, $board_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/boards');
    }

    public function test_削除()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');
        $response = $this->post($first_path, $board_data);

        // 削除
        $board = Board::latest()->first();
        $first_path = route('user.boards.destroy', ['board' => $board->id]);

        $response = $this->delete($first_path);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/boards');
    }

    // 異常系
    public function test_ログインしていなければ新規投稿できない()
    {
        $response = $this->get(route("user.boards.create"));

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/login');
    }

    public function test_タイトルがないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => '',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');

        $response = $this->post($first_path, $board_data);

        $response->assertSessionHasErrorsIn("titleは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect('/boards');
    }

    public function test_日付がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => 'Test Title',
            'date' => '',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');

        $response = $this->post($first_path, $board_data);

        $response->assertSessionHasErrorsIn("dateは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect('/boards');
    }

    public function test_待ち合わせ場所がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => 'Test Title',
            'date' => '2022-03-22 23:33:00',
            'location' => '',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');

        $response = $this->post($first_path, $board_data);

        $response->assertSessionHasErrorsIn("locationは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect('/boards');
    }

    public function test_目的地がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => 'Test Title',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');

        $response = $this->post($first_path, $board_data);

        $response->assertSessionHasErrorsIn("destinationは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect('/boards');
    }

    public function test_説明がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $board_data = [
            'title' => 'Test Title',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '',
            'deadline' => true,
            'prefecture_id' => 1,
            'images' => $read_temp_path,
        ];
        $first_path = route('user.boards.store');

        $response = $this->post($first_path, $board_data);

        $response->assertSessionHasErrorsIn("descriptionは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect('/boards');
    }
}
