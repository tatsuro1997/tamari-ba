<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Road;

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
            // RoadSeeder::class,
            BikeUserSeeder::class,
        ]);
        Road::factory(30)->create();
    }
}
