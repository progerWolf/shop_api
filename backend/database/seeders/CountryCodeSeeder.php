<?php

namespace Database\Seeders;

use App\Models\CountryCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonData = File::get('database/data/country_codes.json');

        $data = json_decode($jsonData);

        foreach ($data as $obj) {
            CountryCode::create([
                'name' => $obj->name,
                'iso' => $obj->iso,
                'phone_code' => $obj->phone_code,
                'mask' => $obj->mask,
                'flag' => $obj->flag,
                'is_active' => $obj->is_active
            ]);
        }
    }
}
