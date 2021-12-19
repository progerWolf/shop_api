<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 25; $i++) {
            Shop::create([
                'name' => "Shop name " . $i + 1,
                'address' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ducimus pariatur dolores, ea at',
                'description' => 'dolores, ea at voluptatum repellendus, voluptates quis, sequi voluptatem dignissimos explicabo saepe nesciunt earum voluptate quidem facere deleniti culpa.',
                'phone' => "+992 (000) 2345 33",
                'image' => '/market.jpeg',
                'user_id' => 1,
                'category_id' => $i == 0 ? 1 : random_int(1, 5),
                'opening_hour' => '09:00',
                'closing_hour' => '17:00',
                'delivery_price' => random_int(10, 100),
                'purchase' => random_int(1, 100),
                'status' => 2
            ]);
        }
    }
}
