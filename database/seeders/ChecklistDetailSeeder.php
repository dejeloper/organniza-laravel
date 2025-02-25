<?php

namespace Database\Seeders;

use App\Models\ChecklistDetail;
use Illuminate\Database\Seeder;

class ChecklistDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChecklistDetail::insert(
            [
                [
                    'checklist_header_id' => 1,
                    'product_id' => 1,
                    'pantry_amount_product' => 1,
                    'pantry_unit_product' => 1,
                    'required_amount_product' => 1,
                    'required_unit_product' => 1,
                    'enabled' => true,
                ],
                [
                    'checklist_header_id' => 1,
                    'product_id' => 3,
                    'pantry_amount_product' => 2,
                    'pantry_unit_product' => 2,
                    'required_amount_product' => 2,
                    'required_unit_product' => 2,
                    'enabled' => true,
                ],
                [
                    'checklist_header_id' => 1,
                    'product_id' => 2,
                    'pantry_amount_product' => 1,
                    'pantry_unit_product' => 3,
                    'required_amount_product' => 3,
                    'required_unit_product' => 3,
                    'enabled' => true,
                ],
                [
                    'checklist_header_id' => 2,
                    'product_id' => 1,
                    'pantry_amount_product' => 1,
                    'pantry_unit_product' => 1,
                    'required_amount_product' => 1,
                    'required_unit_product' => 1,
                    'enabled' => true,
                ],
                [
                    'checklist_header_id' => 2,
                    'product_id' => 3,
                    'pantry_amount_product' => 2,
                    'pantry_unit_product' => 2,
                    'required_amount_product' => 2,
                    'required_unit_product' => 2,
                    'enabled' => true,
                ],
                [
                    'checklist_header_id' => 3,
                    'product_id' => 2,
                    'pantry_amount_product' => 1,
                    'pantry_unit_product' => 3,
                    'required_amount_product' => 3,
                    'required_unit_product' => 3,
                    'enabled' => true,
                ],
            ],
        );
    }
}
