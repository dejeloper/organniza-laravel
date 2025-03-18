<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:places,name',
            'short_name' => 'required|string|max:100',
            'bg_color' => 'required|string|regex:/^#([a-fA-F0-9]{6})$/',
            'text_color' => 'required|string|regex:/^#([a-fA-F0-9]{6})$/',
            'enabled' => 'boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            "name.required" => "El campo 'Nombre' es obligatorio.",
            "name.string" => "El campo 'Nombre' debe ser un texto válido.",
            "name.max" => "El campo 'Nombre' no debe exceder los 255 caracteres.",
            "name.unique" => "El 'nombre' ingresado ya está en uso.",

            "short_name.required" => "El campo 'Nombre corto' es obligatorio.",
            "short_name.string" => "El campo 'Nombre corto' debe ser un texto válido.",
            "short_name.max" => "El campo 'Nombre corto' no debe exceder los 100 caracteres.",

            "bg_color.required" => "El campo 'Color de fondo' es obligatorio.",
            "bg_color.string" => "El campo 'Color de fondo' debe ser un texto válido.",
            "bg_color.regex" => "El campo 'Color de fondo' debe ser un código hexadecimal válido (#RRGGBB).",

            "text_color.required" => "El campo 'Color de texto' es obligatorio.",
            "text_color.string" => "El campo 'Color de texto' debe ser un texto válido.",
            "text_color.regex" => "El campo 'Color de texto' debe ser un código hexadecimal válido (#RRGGBB).",

            "enabled.boolean" => "El campo 'Habilitado debe ser verdadero o falso.",
        ];
    }
}
