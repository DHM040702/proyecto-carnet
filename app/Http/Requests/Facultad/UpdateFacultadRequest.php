<?php

namespace App\Http\Requests\Facultad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacultadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'facultad' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\'0-9]+$/u'],
            'abreviatura' => ['nullable', 'string', 'max:50', 'regex:/^[A-Z0-9\-]+$/'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'facultad.required' => 'El nombre de la facultad es obligatorio.',
            'facultad.regex' => 'El nombre de la facultad contiene caracteres inválidos.',
            'abreviatura.regex' => 'La abreviatura solo puede contener letras mayúsculas, números y guiones.',
        ];
    }
}
