<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChecklistDetailRequest extends FormRequest
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
            'checklist_header_id' => 'sometimes|exists:checklist_headers,id',
            'product_id' => 'sometimes|exists:products,id',
            'pantry_amount_product' => 'sometimes|numeric|min:0',
            'pantry_unit_product' => 'sometimes|exists:units,id',
            'required_amount_product' => 'sometimes|numeric|min:0',
            'required_unit_product' => 'sometimes|exists:units,id',
            'enabled' => 'sometimes|boolean',
        ];
    }
}
