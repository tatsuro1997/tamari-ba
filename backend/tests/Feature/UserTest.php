<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\PrefectureSeeder;
use Illuminate\Http\UploadedFile;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    // 正常系
    public function testUserProfile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/users/profile');

        $response->assertStatus(200);
    }

    public function testUserEdit()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/users/$user->id/edit");

        $response->assertStatus(200);
    }

    public function testUserUpdate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("/users/$user->id/edit");

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $user_data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'age' => 21,
            'gender' => 0,
            'prefecture_id' => 1,
            'years_of_experience' => 3,
            'through' => true,
            'avatar' => $read_temp_path,
       ];
       $first_path = route('user.update', ['user' => $user->id]);

       $response = $this->put($first_path, $user_data);

        $response->assertStatus(302);
        // エラーメッセージがないこと
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/users/profile');
    }


    // 異常系

    public function test_ログインしていれば登録ページに遷移できない()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/roads');

        $response = $this->get('/register');

        $response->assertStatus(302);
        $response->assertRedirect('/bikes');
    }
}
