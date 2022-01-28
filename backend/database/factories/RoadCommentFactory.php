<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class RoadCommentFactory extends Factory
{
    public function definition()
    {
        return [
            'comment' => $this->faker->paragraph(),
            'road_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 3),
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today(),
        ];
    }
}
