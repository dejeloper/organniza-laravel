<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'place_id' => 'required|exists:places,id',
            'status_id' => 'nullable|exists:product_statuses,id',
            'observation' => 'nullable|string',
            'image' => 'nullable|string',
            'enabled' => 'boolean',
        ];
    }
}
