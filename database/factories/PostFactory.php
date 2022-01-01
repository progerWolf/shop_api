<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6, true),
            'description' => $this->faker->paragraph(100, true),
            'short_description' => $this->faker->paragraph(50, true),
            'image' => '/images/rest.png',
            'is_active' => $this->faker->boolean,
            'type' => $this->faker->randomElement(['post', 'about'])
        ];
    }
}
