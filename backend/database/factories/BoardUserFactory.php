<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoardUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'board_id' => $this->faker->numberBetween(1, 20),
            'user_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
