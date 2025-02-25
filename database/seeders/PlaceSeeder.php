<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::insert([
            [
                'name' => "Supermercado Zapatoca",
                'short_name' => "Zapatoca",
                'bg_color' => "#009688",
                'text_color' => "#FFFFFF",
                'enabled' => true,
            ],
            [
                'name' => "Supermercado La Granja",
                'short_name' => "La Granja",
                'bg_color' => "#FF5733",
                'text_color' => "#FFFFFF",
                'enabled' => true,
            ],
            [
                'name' => "Supermercado El Mercado",
                'short_name' => "El Mercado",
                'bg_color' => "#FFC107",
                'text_color' => "#FFFFFF",
                'enabled' => true,
            ],
            [
                'name' => "Supermercado La Bodega",
                'short_name' => "La Bodega",
                'bg_color' => "#9C27B0",
                'text_color' => "#FFFFFF",
                'enabled' => true,
            ],
            [
                'name' => "Supermercado El Rincon",
                'short_name' => "El Rincon",
                'bg_color' => "#FFFFFF",
                'text_color' => "#000000",
                'enabled' => true,
            ],
        ]);
    }
}
