<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            PlaceSeeder::class,
            ProductStatusSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            ChecklistHeaderSeeder::class,
            ChecklistDetailSeeder::class,
            PurchasesHistoryHeaderSeeder::class,
            PurchasesHistoryDetailSeeder::class,
        ]);
    }
}
