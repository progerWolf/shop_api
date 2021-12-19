<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => "Test User",
            'phone' => "992000000000",
            'password' => "password",
            'is_active' => 1,
            'country_code_id' => 2
        ]);

        $this->call(CountryCodeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(LaratrustSeeder::class);
    }
}
