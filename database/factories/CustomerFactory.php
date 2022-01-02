<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => "+992" .
                $this->faker->randomElement(['988', '502', '777', '937', '900']) .
                $this->faker->unique->biasedNumberBetween(000000,999999),
            'country_code_id' => 2,
        ];
    }
}
