<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoardFactory extends Factory
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
            'date' => $this->faker->dateTimeBetween('1day', '1year')->format('Y-m-d H:i'),
            'location' => 'ここに出発地が入ります。',
            'destination' => 'ここに目的地が入ります。',
            'description' => $this->faker->text,
            'deadline' => $this->faker->numberBetween(0, 1),
            'prefecture_id' => $this->faker->numberBetween(1, 47),
            'user_id' => $this->faker->numberBetween(1,3),
        ];
    }
}
