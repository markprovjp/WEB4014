<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Dell XPS 13',
            'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
            'price' => 1299.99,
            'quantity' => 10
        ]);

        Product::create([
            'name' => 'iPhone 15 Pro',
            'description' => 'Latest iPhone model with A17 chip and Pro camera system',
            'price' => 999.99,
            'quantity' => 15
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S23',
            'description' => 'Android smartphone with 120Hz display and 108MP camera',
            'price' => 899.99,
            'quantity' => 20
        ]);
    }
}
