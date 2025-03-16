<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchasesHistoryDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'purchases_history_header_id' => 'sometimes|exists:purchases_history_headers,id',
            'product_id' => 'sometimes|exists:products,id',
            'amount_product' => 'sometimes|integer|min:1',
            'unit_product_id' => 'sometimes|exists:units,id',
            'sub_total_product' => 'sometimes|numeric|min:0',
            'enabled' => 'sometimes|boolean',
        ];
    }
}
