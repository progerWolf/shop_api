<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Все рестораны',
            'image' => '/images/rest.png',
            'short_desc'  => 'Lorem ipsum dolor sit amet, . Iusto, sunt!',
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Все магазины',
            'image' => '/images/shop.jpg',
            'short_desc'  => 'Lorem, consectetur adipisicing elit. Iusto, sunt!',
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Напитки',
            'image' => '/images/napitki.jpg',
            'short_desc'  => 'Lorem amet, consectetur adipisicing elit. Iusto, sunt!',
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Лекарство',
            'image' => '/images/lekarstvo.jpg',
            'short_desc'  => 'Sit amet adipisicing elit. Iusto, sunt!',
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Пицца',
            'image' => '/images/pizza.png',
            'short_desc'  => 'Lorem ipsum dolor sit amet, consectetur!',
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Бургеры',
            'image' => '/images/burger.png',
            'short_desc'  => 'Lorem ipsum dolor sit amet, . Iusto, sunt!',
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Блюда',
            'parent_id' => 1,
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'закуски',
            'parent_id' => 1,
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Мёд',
            'parent_id' => 1,
            'is_active' => 1
        ]);

        Category::create([
            'name' => 'Напитки',
            'parent_id' => 1,
            'is_active' => 1
        ]);
    }
}
