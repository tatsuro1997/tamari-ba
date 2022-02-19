<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Road;
use Database\Seeders\PrefectureSeeder;
use Illuminate\Http\UploadedFile;

class RoadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    // 正常系

    public function test_ログインしていると一覧が見れる()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/roads');

        $response->assertStatus(200);
    }

    public function test_新規投稿()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => 'Test Road',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'prefectire_id' => 1,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');

        $response = $this->post($first_path, $road_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/roads');
    }

    public function test_詳細()
    {
        $user = User::factory()->create();
        $road = Road::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads/$road->id");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_編集()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        // 更新前
        $road_data = [
            'title' => 'Test Road',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'prefectire_id' => 1,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');
        $response = $this->post($first_path, $road_data);

        // 更新
        $road_data = [
            'title' => 'Update Road',
            'latitude' => '34.654321',
            'longitude' => '134.654321',
            'prefectire_id' => 2,
            'description' => '更新されました。',
            'images' => $read_temp_path,
        ];

        // 最新の投稿を指定
        $road = Road::latest()->first();
        $first_path = route('user.roads.update', ['road' => $road->id]);

        $response = $this->put($first_path, $road_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/roads');
    }

    public function test_削除()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => 'Test Road',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'prefectire_id' => 1,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');
        $response = $this->post($first_path, $road_data);

        // 削除
        $road = Road::latest()->first();
        $first_path = route('user.roads.destroy', ['road' => $road->id]);

        $response = $this->delete($first_path);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/roads');
    }


    // 異常系
    public function test_ログインしていなければ新規投稿できない()
    {
        $response = $this->get(route("user.roads.create"));

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
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => '',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'prefectire_id' => 1,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');

        $response = $this->post($first_path, $road_data);

        $response->assertSessionHasErrorsIn("titleは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.roads.index'));
    }

    public function test_緯度がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => 'テスト',
            'latitude' => '',
            'longitude' => '134.123456',
            'prefectire_id' => 1,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');

        $response = $this->post($first_path, $road_data);

        $response->assertSessionHasErrorsIn("latitudeは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.roads.index'));
    }

    public function test_経度がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => 'テスト',
            'latitude' => '34.123456',
            'longitude' => '',
            'prefectire_id' => 1,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');

        $response = $this->post($first_path, $road_data);

        $response->assertSessionHasErrorsIn("longitudeは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.roads.index'));
    }

    public function test_都道府県がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => 'テスト',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'prefectire_id' => '',
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');

        $response = $this->post($first_path, $road_data);

        $response->assertSessionHasErrorsIn("prefecture_idは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.roads.index'));
    }

    public function test_説明がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $road_data = [
            'title' => 'テスト',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'prefectire_id' => 1,
            'description' => '',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.roads.store');

        $response = $this->post($first_path, $road_data);

        $response->assertSessionHasErrorsIn("descriptionは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.roads.index'));
    }
}
