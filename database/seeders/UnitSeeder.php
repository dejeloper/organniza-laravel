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
                'short_name' => 'kg',
                'enabled' => true,
            ],
            [
                'name' => 'Lbs',
                'short_name' => 'lbs',
                'enabled' => true,
            ],
            [
                'name' => 'Gramos',
                'short_name' => 'g',
                'enabled' => true,
            ],
            [
                'name' => 'Mililitros',
                'short_name' => 'ml',
                'enabled' => true,
            ],
            [
                'name' => 'Litros',
                'short_name' => 'l',
                'enabled' => true,
            ],
            [
                'name' => 'Centímetros Cúbicos',
                'short_name' => 'cm',
                'enabled' => true,
            ],
            [
                'name' => 'Onzas',
                'short_name' => 'oz',
                'enabled' => true,
            ],
        ]);
    }
}
