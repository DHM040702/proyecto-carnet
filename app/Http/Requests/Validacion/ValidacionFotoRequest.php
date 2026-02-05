<?php

namespace App\Http\Requests\Validacion;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionFotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'foto' => [
                'required',
                'file',
                'mimes:jpg,jpeg',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'foto.required' => 'Debe subir una fotografía.',
            'foto.mimes' => 'La imagen debe estar en formato JPG.',
            'foto.max' => 'La imagen no debe superar los 2MB.',
        ];
    }
}