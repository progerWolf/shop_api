<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => "Product name " . $i + 1,
                'short_desc' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, maiores? At libero neque cupiditate nemo dolorum sint consequuntur enim ipsum sapiente soluta! Velit aliquam totam hic quos ipsa perspiciatis tenetur.",
                'images' => [
                    '/images/1.jpg',
                    '/images/2.jpg',
                    '/images/3.jpg'
                ],
                'price' => random_int(1, 1000),
                'user_id' => 1,
                'product_category_id' => ProductCategory::select('id')->where('parent_id', 1)->inRandomOrder()->first()->id,
                'shop_id' => 1,
                'status' => Product::STATUS_PUBLISHED,
            ]);
        }
    }
}
