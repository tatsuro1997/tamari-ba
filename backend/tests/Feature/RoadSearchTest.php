<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\PrefectureSeeder;

class RoadSearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PrefectureSeeder::class);
    }

    public function test_タイトルで道の検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $road_data = [
            'title' => 'Test Road',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'description' => '説明が入ります',
        ];
        $first_path = route('user.roads.store');
        $response = $this->post($first_path, $road_data);

        // 検索
        $searchpath = route('user.roads.index');
        $response = $this->get($searchpath, [
            'search' => 'Road',
        ]);

        $response->assertSee('道の投稿一覧');
        $response->assertSee('検索');
        $this->assertEquals('Test Road', $road_data['title']);
        $this->assertEquals('説明が入ります', $road_data['description']);
    }

    public function test_説明で道の検索()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get("roads");

        $road_data = [
            'title' => 'Test Road',
            'latitude' => '34.123456',
            'longitude' => '134.123456',
            'description' => '説明が入ります',
        ];
        $first_path = route('user.roads.store');
        $response = $this->post($first_path, $road_data);

        // 検索
        $searchpath = route('user.roads.index');
        $response = $this->get($searchpath, [
            'search' => '説明',
        ]);

        $response->assertSee('道の投稿一覧');
        $response->assertSee('検索');
        $this->assertEquals('Test Road', $road_data['title']);
        $this->assertEquals('説明が入ります', $road_data['description']);
    }

}
