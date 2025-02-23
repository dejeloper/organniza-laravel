<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'name' => 'Frutas',
                'icon' => '🍎',
                'bg_color' => '#009688',
                'text_color' => '#FFFFFF',
                'enabled' => true,
            ],
            [
                'name' => 'Verduras',
                'icon' => '🥦',
                'bg_color' => '#FF5733',
                'text_color' => '#FFFFFF',
                'enabled' => true,
            ],
            [
                'name' => 'Carnes',
                'icon' => '🥩',
                'bg_color' => '#FFC107',
                'text_color' => '#FFFFFF',
                'enabled' => true,
            ],
            [

                'name' => 'Limpieza',
                'icon' => '🧹',
                'bg_color' => '#9C27B0',
                'text_color' => '#FFFFFF',
                'enabled' => true,
            ],
            [
                'name' => 'Casa',
                'icon' => '🏠',
                'bg_color' => '#FFFFFF',
                'text_color' => '#000000',
                'enabled' => true,
            ],
        ]);
    }
}
