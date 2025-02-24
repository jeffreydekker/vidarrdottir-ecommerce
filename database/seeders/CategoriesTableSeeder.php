<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Gadgets and devices'],
            ['name' => 'Clothing', 'slug' => 'clothing', 'description' => 'Apparel and accessories'],
        ]);
    }
}
