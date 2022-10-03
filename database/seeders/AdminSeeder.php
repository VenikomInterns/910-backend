<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{

    public function run()
    {
        User::query()->create([
            'name'=>'Admin',
            'admin'=>true,
            'email'=>'admin@gmail.com',
            'password' => bcrypt('admin123'),

        ]);

    }
}
