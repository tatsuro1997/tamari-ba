<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\PrefectureSeeder;

class BikeSearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    public function test_タイトルでバイクの検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $bike_data = [
            'title' => 'Test bike',
            'bike_brand' => 'HONDA',
            'bike_type' => 'スポーツ',
            'bike_name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
        ];
        $first_path = route('user.bikes.store');
        $response = $this->post($first_path, $bike_data);

        // 検索
        $searchpath = route('user.bikes.index');
        $response = $this->get($searchpath, [
            'search' => 'bike',
        ]);

        $response->assertSee('検索');
        $response->assertSee('新規登録');
        $this->assertEquals('Test bike', $bike_data['title']);
        $this->assertEquals('説明が入ります', $bike_data['description']);
    }

    public function test_ブランドでバイクの検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $bike_data = [
            'title' => 'Test bike',
            'bike_brand' => 'HONDA',
            'bike_type' => 'スポーツ',
            'bike_name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
        ];
        $first_path = route('user.bikes.store');
        $response = $this->post($first_path, $bike_data);

        // 検索
        $searchpath = route('user.bikes.index');
        $response = $this->get($searchpath, [
            'search' => 'honda',
        ]);

        $response->assertSee('検索');
        $response->assertSee('新規登録');
        $this->assertEquals('Test bike', $bike_data['title']);
        $this->assertEquals('HONDA', $bike_data['bike_brand']);
    }

    public function test_排気量でバイクの検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $bike_data = [
            'title' => 'Test bike',
            'bike_brand' => 'HONDA',
            'bike_type' => 'スポーツ',
            'bike_name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
        ];
        $first_path = route('user.bikes.store');
        $response = $this->post($first_path, $bike_data);

        // 検索
        $searchpath = route('user.bikes.index');
        $response = $this->get($searchpath, [
            'search' => '1000',
        ]);

        $response->assertSee('検索');
        $response->assertSee('新規登録');
        $this->assertEquals('Test bike', $bike_data['title']);
        $this->assertEquals('1000', $bike_data['engine_size']);
    }

    public function test_説明でバイクの検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("bikes");

        $bike_data = [
            'title' => 'Test bike',
            'bike_brand' => 'HONDA',
            'bike_type' => 'スポーツ',
            'bike_name' => 'CBR1000RR',
            'engine_size' => 1000,
            'description' => '説明が入ります',
        ];
        $first_path = route('user.bikes.store');
        $response = $this->post($first_path, $bike_data);

        // 検索
        $searchpath = route('user.bikes.index');
        $response = $this->get($searchpath, [
            'search' => '説明',
        ]);

        $response->assertSee('検索');
        $response->assertSee('新規登録');
        $this->assertEquals('Test bike', $bike_data['title']);
        $this->assertEquals('説明が入ります', $bike_data['description']);
    }

}
