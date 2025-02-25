<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchasesHistoryHeaderRequest extends FormRequest
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
            'year' => 'sometimes|integer|min:2000|max:' . date('Y'),
            'month' => 'sometimes|integer|min:1|max:12',
            'amount_purchase' => 'sometimes|integer|min:1',
            'total_purchase' => 'sometimes|numeric|min:0',
            'enabled' => 'sometimes|boolean',
        ];
    }
}
