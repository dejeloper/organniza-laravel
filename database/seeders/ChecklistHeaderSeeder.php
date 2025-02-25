<?php

namespace Database\Seeders;

use App\Models\ChecklistHeader;
use Illuminate\Database\Seeder;

class ChecklistHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChecklistHeader::insert([
            [
                'year' => 2025,
                'month' => 1,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 2,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 3,
                'enabled' => true,
            ]
        ]);
    }
}
