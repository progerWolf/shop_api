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
            'image' => $this->faker->image(),
            'is_active' => true,
            'type' => $this->faker->sentence(1, true)
        ];
    }
}
