<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
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
            Attribute::create([
                "name" => $obj->name,
                "value" => $obj->value,
                "attribute_group_id" => 1,
                'is_active' => 1
            ]);
        }
    }
}
