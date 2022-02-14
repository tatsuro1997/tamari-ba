<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BikeFactory extends Factory
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
            'maker_id' => $this->faker->numberBetween(1, 18),
            'type_id' => $this->faker->numberBetween(1, 16),
            'name' => $this->faker->firstNameFemale,
            'engine_size' => $this->faker->numberBetween(125, 1200),
            'description' => $this->faker->text,
            'user_id' => $this->faker->numberBetween(1, 3),
            'created_at' => $this->faker->dateTime,
        ];
    }
}
