<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Smartphone',
                'slug' => 'smartphone',
                'description' => 'Latest model with all features.',
                'short_description' => 'A powerful smartphone.',
                'price' => 599.99,
                'discount_price' => null,
                'stock' => 50,
                'sku' => 'SM12345',
                'image' => 'smartphone.jpg',
                'category_id' => 1,  // Ensure this matches an existing category ID in your categories table
                'tags' => 'smartphone, gadget, electronics',
                'meta_title' => 'Smartphone for sale',
                'meta_description' => 'Best smartphone in the market.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'T-shirt',
                'slug' => 't-shirt',
                'description' => 'Comfortable cotton t-shirt.',
                'short_description' => 'Soft and stylish.',
                'price' => 19.99,
                'discount_price' => 14.99,
                'stock' => 100,
                'sku' => 'TS12345',
                'image' => 'tshirt.jpg',
                'category_id' => 2,  // Assuming category ID 2 exists in categories table
                'tags' => 't-shirt, clothing, fashion',
                'meta_title' => 'Cotton T-shirt',
                'meta_description' => 'Comfortable cotton T-shirt for everyday wear.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
