<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;

class RegistrationTest extends TestCase
{
    //正常系

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $response = $this->post('/register', [
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
        ]);

        $response->assertRedirect('/');
    }

    public function test_間違ったパスワードの場合()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

    // パスワードが正しく無い状態でログイン
        $response = $this->post('/register', [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'passwor',
                'password_confirmation' => 'passwor',
                'age' => 21,
                'gender' => 0,
                'prefecture_id' => 1,
                'years_of_experience' => 3,
                'through' => true,
                'avatar' => $read_temp_path,
            ]);
    // リダイレクトで戻ってくる。
        $response->assertStatus(302);
    // リダイレクトで戻ってきた時はログインページにいる事
        $response->assertRedirect('/login');
    // 失敗しているので認証されていない事
        $this->assertGuest();
    }

    public function test_ログアウトが正しくできるか()
    {
        // ログイン状態の作成
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/roads');

        $response->assertStatus(200);
        // ログアウト処理をする
        $this->post('logout');
        // ログアウト出来たら200番が帰ってきているか
        $response->assertStatus(200);
        // ログインページにいる事
        $response = $this->get('/login');
        $response->assertStatus(200);
        // 認証されていないことを確認
        $this->assertGuest();
    }


    // 異常系

    public function test_Emailが重複していれば登録できない()
   {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $response = $this->post('/register', [
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
        ]);

        $response->assertSessionHasErrorsIn("そのメールアドレスはすでに使われています。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.register'));
   }

   public function test_Passwordが8文字以下であれば登録できない()
   {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $password = 'T';

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $password,
            'password_confirmation' => $password,
            'age' => 21,
            'gender' => 0,
            'prefecture_id' => 1,
            'years_of_experience' => 3,
            'through' => true,
            'avatar' => $read_temp_path,
        ]);

        $response->assertSessionHasErrorsIn("パスワードは8文字以上で入力してください");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.register'));
   }

    public function test_Passwordが一致していないと登録できない()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $file = UploadedFile::fake()->image('avatar.jpg');
        $path = $file->store('public');
        $read_temp_path = str_replace('public/', '/storage/', $path);

        $password = 'password';
        $c_password = 'cpassword';

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $password,
            'password_confirmation' => $c_password,
            'age' => 21,
            'gender' => 0,
            'prefecture_id' => 1,
            'years_of_experience' => 3,
            'through' => true,
            'avatar' => $read_temp_path,
        ]);

        $response->assertSessionHasErrorsIn("パスワードが確認用の値と一致しません。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.register'));
    }

    public function test_アバターがないと登録できない()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $password = 'password';

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $password,
            'password_confirmation' => $password,
            'age' => 21,
            'gender' => 0,
            'prefecture_id' => 1,
            'years_of_experience' => 3,
            'through' => true,
            'avatar' => '',
        ]);

        $response->assertSessionHasErrorsIn("avatarは必須です。");
        $response->assertStatus(302);
        $response->assertRedirect(route('user.register'));
    }
}
