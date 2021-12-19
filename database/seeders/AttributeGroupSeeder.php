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
            ['name' => 'Цвет'],
            ['name' => 'Размер'],
            ['name' => 'Дизайн'],
            ['name' => 'Масса'],
            ['name' => 'Содержание'],
            ['name' => 'Запах'],
            ['name' => 'Вкус'],
            ['name' => 'Чувствовать'],
            ['name' => 'Количество'],
            ['name' => 'Упаковка'],
        ]);
    }
}







