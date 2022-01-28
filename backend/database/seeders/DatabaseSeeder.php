<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Road;
use App\Models\Board;
use App\Models\RoadComment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            BikeSeeder::class,
            PrefectureSeeder::class,
            UserSeeder::class,
            BikeUserSeeder::class,
        ]);
        Road::factory(20)->create();
        Board::factory(20)->create();
        RoadComment::factory(30)->create();

        $this->call([
            RoadImageSeeder::class,
            BoardImageSeeder::class,
        ]);
    }
}
