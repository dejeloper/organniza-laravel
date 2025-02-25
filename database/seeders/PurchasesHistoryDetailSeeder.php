<?php

namespace Database\Seeders;

use App\Models\PurchasesHistoryDetail;
use Illuminate\Database\Seeder;

class PurchasesHistoryDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'purchases_history_header_id' => 1,
                'product_id' => 1,
                'amount_product' => 10,
                'unit_product' => 1,
                'sub_total_product' => 250.50,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 1,
                'product_id' => 2,
                'amount_product' => 8,
                'unit_product' => 1,
                'sub_total_product' => 180.75,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 2,
                'product_id' => 3,
                'amount_product' => 5,
                'unit_product' => 2,
                'sub_total_product' => 300.00,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 2,
                'product_id' => 4,
                'amount_product' => 6,
                'unit_product' => 1,
                'sub_total_product' => 120.50,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 3,
                'product_id' => 1,
                'amount_product' => 7,
                'unit_product' => 1,
                'sub_total_product' => 140.90,
                'enabled' => false,
            ],
            [
                'purchases_history_header_id' => 3,
                'product_id' => 2,
                'amount_product' => 12,
                'unit_product' => 2,
                'sub_total_product' => 480.00,
                'enabled' => false,
            ],
            [
                'purchases_history_header_id' => 4,
                'product_id' => 3,
                'amount_product' => 4,
                'unit_product' => 3,
                'sub_total_product' => 200.00,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 4,
                'product_id' => 4,
                'amount_product' => 15,
                'unit_product' => 4,
                'sub_total_product' => 75.00,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 5,
                'product_id' => 1,
                'amount_product' => 30,
                'unit_product' => 5,
                'sub_total_product' => 360.00,
                'enabled' => true,
            ],
            [
                'purchases_history_header_id' => 5,
                'product_id' => 2,
                'amount_product' => 5,
                'unit_product' => 1,
                'sub_total_product' => 750.00,
                'enabled' => true,
            ],
        ];

        foreach ($data as $record) {
            PurchasesHistoryDetail::create($record);
        }
    }
}
