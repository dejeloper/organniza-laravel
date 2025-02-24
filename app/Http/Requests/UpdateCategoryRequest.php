<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this->category),
            ],
            'icon' => 'sometimes|string|max:255',
            'bg_color' => 'sometimes|string|regex:/^#([a-fA-F0-9]{6})$/',
            'text_color' => 'sometimes|string|regex:/^#([a-fA-F0-9]{6})$/',
            'enabled' => 'sometimes|boolean',
        ];
    }
}
