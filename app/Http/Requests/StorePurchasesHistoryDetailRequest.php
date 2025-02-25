<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchasesHistoryDetailRequest extends FormRequest
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
            'purchases_history_header_id' => 'required|exists:purchases_history_headers,id',
            'product_id' => 'required|exists:products,id',
            'amount_product' => 'required|integer|min:1',
            'unit_product' => 'required|exists:units,id',
            'sub_total_product' => 'required|numeric|min:0',
            'enabled' => 'boolean',
        ];
    }
}
