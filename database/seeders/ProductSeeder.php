<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {
        $category = Category::query()->find(1);
        $category->products()->createMany([
            [
                'name' => 'bronzer',
                'price' => '20',
                'description' => '/',
            ],
            [
                'name' => 'bronzer',
                'price' =>' 20',
                'description' => '/',

            ]
        ]); //excellent


    }

}
