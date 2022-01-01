<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use Illuminate\Database\Seeder;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeGroup::insert([
            ['name' => 'Цвет', 'is_active' => 1],
            ['name' => 'Размер', 'is_active' => 1],
            ['name' => 'Дизайн', 'is_active' => 1],
            ['name' => 'Масса', 'is_active' => 1],
            ['name' => 'Содержание', 'is_active' => 1],
            ['name' => 'Запах', 'is_active' => 1],
            ['name' => 'Вкус', 'is_active' => 1],
            ['name' => 'Чувствовать', 'is_active' => 1],
            ['name' => 'Количество', 'is_active' => 1],
            ['name' => 'Упаковка', 'is_active' => 1],
        ]);
    }
}







