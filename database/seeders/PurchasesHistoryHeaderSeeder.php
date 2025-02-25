<?php

namespace Database\Seeders;

use App\Models\PurchasesHistoryHeader;
use Illuminate\Database\Seeder;

class PurchasesHistoryHeaderSeeder extends Seeder
{
    public function run(): void
    {
        PurchasesHistoryHeader::insert([
            [
                'year' => 2024,
                'month' => 12,
                'amount_purchase' => 41,
                'total_purchase' => 9750.50,
                'enabled' => true,
            ],
            [
                'year' => 2024,
                'month' => 12,
                'amount_purchase' => 39,
                'total_purchase' => 9150.60,
                'enabled' => true,
            ],
            [
                'year' => 2024,
                'month' => 12,
                'amount_purchase' => 57,
                'total_purchase' => 14075.80,
                'enabled' => false,
            ],
            [
                'year' => 2025,
                'month' => 1,
                'amount_purchase' => 50,
                'total_purchase' => 12500.75,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 1,
                'amount_purchase' => 42,
                'total_purchase' => 9875.30,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 1,
                'amount_purchase' => 60,
                'total_purchase' => 14500.00,
                'enabled' => false,
            ],
            [
                'year' => 2025,
                'month' => 1,
                'amount_purchase' => 37,
                'total_purchase' => 8500.45,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 1,
                'amount_purchase' => 55,
                'total_purchase' => 13275.65,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 2,
                'amount_purchase' => 30,
                'total_purchase' => 7650.90,
                'enabled' => false,
            ],
            [
                'year' => 2025,
                'month' => 2,
                'amount_purchase' => 48,
                'total_purchase' => 11200.25,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 2,
                'amount_purchase' => 53,
                'total_purchase' => 12650.75,
                'enabled' => true,
            ],
            [
                'year' => 2025,
                'month' => 2,
                'amount_purchase' => 62,
                'total_purchase' => 15700.35,
                'enabled' => false,
            ],

        ]);
    }
}
