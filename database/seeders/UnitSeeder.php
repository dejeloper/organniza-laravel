<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::insert([
            [
                'name' => 'Kg',
                'nemonico' => 'kg',
                'enabled' => true,
            ],
            [
                'name' => 'Lbs',
                'nemonico' => 'lbs',
                'enabled' => true,
            ],
            [
                'name' => 'Gramos',
                'nemonico' => 'g',
                'enabled' => true,
            ],
            [
                'name' => 'Mililitros',
                'nemonico' => 'ml',
                'enabled' => true,
            ],
            [
                'name' => 'Litros',
                'nemonico' => 'l',
                'enabled' => true,
            ],
            [
                'name' => 'Centímetros Cúbicos',
                'nemonico' => 'cm',
                'enabled' => true,
            ],
            [
                'name' => 'Onzas',
                'nemonico' => 'oz',
                'enabled' => true,
            ],
        ]);
    }
}
