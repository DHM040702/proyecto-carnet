<?php

namespace App\Http\Requests\Semestre;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSemestreRequest extends FormRequest
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
         'semestre' => [
            'required',
            'string',
            'max:50',
            Rule::unique('semestres', 'semestre'),
        ],
        'fecha_inicio' => ['required', 'date'],
        'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
        'fecha_inicio_solicitud' => ['required', 'date'],
        'fecha_fin_solicitud' => ['required', 'date', 'after_or_equal:fecha_inicio_solicitud'],
    ];
    }
}
