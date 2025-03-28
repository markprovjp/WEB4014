<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Thể thao'],
            ['name' => 'Âm nhạc'],
            ['name' => 'Ẩm thực'],
            ['name' => 'Công nghệ'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
