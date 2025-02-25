<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Gamer',
            'description' => 'Laptop con procesador Ryzen 7 y RTX 4060',
            'unit_id' => 1,
            'price' => 1500.00,
            'category_id' => 1,
            'place_id' => 1,
            'status_id' => 1,
            'observation' => 'En oferta por tiempo limitado',
            'image' => 'laptop.jpg',
            'enabled' => true,
        ]);
    }
}
