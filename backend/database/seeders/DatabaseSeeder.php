<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Road;
use App\Models\Board;
use App\Models\Bike;
use App\Models\BikeComment;
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
        $this->call([
            // AdminSeeder::class,
            // OwnerSeeder::class,
            // BikeSeeder::class,
            PrefectureSeeder::class,
            YearsOfExperienceSeeder::class,
            BikeMakerSeeder::class,
            BikeTypeSeeder::class,
            // UserSeeder::class,
            // BikeSeeder::class,
            // RoadSeeder::class,
            // BikeImageSeeder::class,
            // RoadImageSeeder::class,
            // BoardImageSeeder::class,
            TagSeeder::class,
        ]);

        // Bike::factory(20)->create();
        // Road::factory(20)->create();
        // Board::factory(20)->create();
        // BikeComment::factory(30)->create();
        // RoadComment::factory(30)->create();
    }
}
