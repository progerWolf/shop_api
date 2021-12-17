<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'name' => 'Все рестораны',
            'image' => '/images/rest.png',
            'short_desc'  => 'Lorem ipsum dolor sit amet, . Iusto, sunt!',
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Все магазины',
            'image' => '/images/shop.jpg',
            'short_desc'  => 'Lorem, consectetur adipisicing elit. Iusto, sunt!',
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Напитки',
            'image' => '/images/napitki.jpg',
            'short_desc'  => 'Lorem amet, consectetur adipisicing elit. Iusto, sunt!',
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Лекарство',
            'image' => '/images/lekarstvo.jpg',
            'short_desc'  => 'Sit amet adipisicing elit. Iusto, sunt!',
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Пицца',
            'image' => '/images/pizza.png',
            'short_desc'  => 'Lorem ipsum dolor sit amet, consectetur!',
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Бургеры',
            'image' => '/images/burger.png',
            'short_desc'  => 'Lorem ipsum dolor sit amet, . Iusto, sunt!',
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Блюда',
            'parent_id' => 1,
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'закуски',
            'parent_id' => 1,
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Мёд',
            'parent_id' => 1,
            'is_active' => 1
        ]);

        ProductCategory::create([
            'name' => 'Напитки',
            'parent_id' => 1,
            'is_active' => 1
        ]);
    }
}
