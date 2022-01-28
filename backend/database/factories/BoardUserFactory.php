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
        for ($i = 1; $i < 20; $i++){
            return [
                'board_id' => $i,
                'user_id' => $this->faker->numberBetween(1, 3),
            ];
        }
    }
}
