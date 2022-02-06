<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\PrefectureSeeder;

class BoardSearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    public function test_タイトルで掲示板の検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
        ];
        $first_path = route('user.boards.store');
        $response = $this->post($first_path, $board_data);

        // 検索
        $searchpath = route('user.boards.index');
        $response = $this->get($searchpath, [
            'search' => 'Road',
        ]);

        $response->assertSee('ツーリング掲示板');
        $response->assertSee('検索');
        $this->assertEquals('Test Board', $board_data['title']);
        $this->assertEquals('説明が入ります', $board_data['description']);
    }

    public function test_説明で掲示板の検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
        ];
        $first_path = route('user.boards.store');
        $response = $this->post($first_path, $board_data);

        // 検索
        $searchpath = route('user.boards.index');
        $response = $this->get($searchpath, [
            'search' => '説明',
        ]);

        $response->assertSee('ツーリング掲示板');
        $response->assertSee('検索');
        $this->assertEquals('Test Board', $board_data['title']);
        $this->assertEquals('説明が入ります', $board_data['description']);
    }

    public function test_出発地で掲示板の検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
        ];
        $first_path = route('user.boards.store');
        $response = $this->post($first_path, $board_data);

        // 検索
        $searchpath = route('user.boards.index');
        $response = $this->get($searchpath, [
            'search' => '東京',
        ]);

        $response->assertSee('ツーリング掲示板');
        $response->assertSee('検索');
        $this->assertEquals('Test Board', $board_data['title']);
        $this->assertEquals('説明が入ります', $board_data['description']);
    }


    public function test_目的地で掲示板の検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("boards");

        $board_data = [
            'title' => 'Test Board',
            'date' => '2022-03-22 23:33:00',
            'location' => '東京',
            'destination' => '北海道',
            'description' => '説明が入ります',
            'deadline' => true,
            'prefecture_id' => 1,
        ];
        $first_path = route('user.boards.store');
        $response = $this->post($first_path, $board_data);

        // 検索
        $searchpath = route('user.boards.index');
        $response = $this->get($searchpath, [
            'search' => '北海道',
        ]);

        $response->assertSee('ツーリング掲示板');
        $response->assertSee('検索');
        $this->assertEquals('Test Board', $board_data['title']);
        $this->assertEquals('説明が入ります', $board_data['description']);
    }
}
