<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'confirmed' => $this->faker->boolean,
            'confirm_code' => $this->faker->unique->numberBetween(1111, 9999)
        ];
    }
}
