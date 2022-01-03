<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(1, 99),
            'description' => $this->faker->text('20'),
            'title' => $this->faker->title,
            'img' => $this->faker->image
        ];
    }
}
