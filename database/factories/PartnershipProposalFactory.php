<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartnershipProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'passport_front_side' => $this->faker->image(),
            'passport_back_side' => $this->faker->image(),
            'selfie_with_passport' => $this->faker->image(),
            'type' => $this->faker->randomElement(['courier', 'store']),
            'status' => $this->faker->randomElement(['moderation', 'cancelled', 'accepted'])
        ];
    }
}
