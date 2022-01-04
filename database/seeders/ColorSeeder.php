<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = File::get('database/data/colors.json');

        $data = json_decode($jsonData);

        foreach ($data as $obj) {
            Color::create([
                "name" => $obj->name,
                "value" => $obj->value,
            ]);
        }
    }
}
