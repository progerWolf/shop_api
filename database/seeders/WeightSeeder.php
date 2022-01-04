<?php

namespace Database\Seeders;

use App\Models\Weight;
use Illuminate\Database\Seeder;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Weight::insert([
            ['name' => 'гр'],
            ['name' => 'кг'],
            ['name' => 'шт'],
        ]);
    }
}
