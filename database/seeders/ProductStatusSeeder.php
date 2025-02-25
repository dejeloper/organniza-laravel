<?php

namespace Database\Seeders;

use App\Models\ProductStatus;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductStatus::insert([
            [
                'name' => 'En Venta',
            ],
            [
                'name' => 'En Reparación',
            ],
            [
                'name' => 'En Entrega',
            ],
            [
                'name' => 'En Espera',
            ]
        ]);
    }
}
