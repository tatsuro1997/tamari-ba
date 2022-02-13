<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Bike;
use Database\Seeders\PrefectureSeeder;
use Illuminate\Http\UploadedFile;

class BikeTest extends TestCase
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
            ->get('/bikes');

        $response->assertStatus(200);
    }

    public function test_新規投稿()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/bikes');
    }

    public function test_詳細()
    {
        $user = User::factory()->create();
        $bike = Bike::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes/$bike->id");

        $response->assertStatus(200);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
    }

    public function test_編集()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        // 更新前
        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');
        $response = $this->post($first_path, $bike_data);

        // 更新
        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR600RR',
            'engine_size' => 600,
            'description' => '更新されました。',
            'images' => $read_temp_path,
        ];

        // 最新の投稿を指定
        $bike = Bike::latest()->first();
        $first_path = route('user.bikes.update', ['bike' => $bike->id]);

        $response = $this->put($first_path, $bike_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/bikes');
    }

    public function test_削除()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');
        $response = $this->post($first_path, $bike_data);

        // 削除
        $bike = Bike::latest()->first();
        $first_path = route('user.bikes.destroy', ['bike' => $bike->id]);

        $response = $this->delete($first_path);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/bikes');
    }


    // 異常系
    public function test_ログインしていなければ新規投稿できない()
    {
        $response = $this->get(route("user.bikes.create"));

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
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => '',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertSessionHasErrorsIn("titleは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.bikes.index'));
    }

    public function test_メーカーがないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => '',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertSessionHasErrorsIn("maker_idは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.bikes.index'));
    }

    public function test_タイプがないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => '',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertSessionHasErrorsIn("type_idは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.bikes.index'));
    }

    public function test_名前がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => '',
            'engine_size' => 1000,
            'description' => '説明が入ります。',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertSessionHasErrorsIn("nameは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.bikes.index'));
    }

    public function test_排気量がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => '',
            'description' => '説明が入ります。',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertSessionHasErrorsIn("engine_sizeは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.bikes.index'));
    }

    public function test_説明がないと新規投稿できない()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $bike_data = [
            'title' => 'Test bike',
            'maker_id' => 'HONDA',
            'type_id' => 'スポーツ',
            'name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '',
            'images' => $read_temp_path,
        ];
        $first_path = route('user.bikes.store');

        $response = $this->post($first_path, $bike_data);

        $response->assertSessionHasErrorsIn("descriptionは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.bikes.index'));
    }
}
