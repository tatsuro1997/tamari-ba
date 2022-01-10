<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'description' => $this->faker->text,
            'user_id' => $this->faker->numberBetween(1, 3),
            'created_at' => $this->faker->dateTime,
        ];
    }
}
