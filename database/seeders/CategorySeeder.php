<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run()
    {
        Category::query()->create([
            'name' => 'Makeup'
        ]);
        Category::query()->create([
            'name' => 'Parfumes'
        ]);
        Category::query()->create([
            'name' => 'Skincare'
        ]);
         //excellent
    }

}
