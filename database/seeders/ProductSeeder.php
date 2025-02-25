<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
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
            ],
            [
                'name' => 'Tv LCD',
                'description' => 'TV 4K Color Negro 65" LCD',
                'unit_id' => 1,
                'price' => 1500.00,
                'category_id' => 1,
                'place_id' => 1,
                'status_id' => 1,
                'observation' => 'En oferta por tiempo limitado',
                'image' => 'tv.jpg',
                'enabled' => true,
            ],
            [
                'name' => 'Keyboard Lenovo',
                'description' => 'Teclado Lenovo New Idea',
                'unit_id' => 1,
                'price' => 1500.00,
                'category_id' => 1,
                'place_id' => 1,
                'status_id' => 1,
                'observation' => 'En oferta por tiempo limitado',
                'image' => 'keyboard.jpg',
                'enabled' => true,

            ],
            [
                'name' => 'Mouse Optical',
                'description' => 'Mouse Optical',
                'unit_id' => 1,
                'price' => 1500.00,
                'category_id' => 1,
                'place_id' => 1,
                'status_id' => 1,
                'observation' => 'En oferta por tiempo limitado',
                'image' => 'mouse.jpg',
                'enabled' => true,
            ]
        ]);
    }
}
