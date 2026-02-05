<?php

namespace App\Http\Requests\Escuela;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEscuelaRequest extends FormRequest
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
            'escuela' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-\'0-9]+$/u'],
            'facultad_id' => ['required', 'integer', 'exists:facultades,id'],
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
            'escuela.required' => 'El nombre de la escuela es obligatorio.',
            'escuela.regex' => 'El nombre de la escuela contiene caracteres inválidos.',
            'facultad_id.required' => 'Debe seleccionar una facultad.',
            'facultad_id.exists' => 'La facultad seleccionada no existe.',
        ];
    }
}
