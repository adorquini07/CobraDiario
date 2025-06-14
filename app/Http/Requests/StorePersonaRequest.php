<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nuip' => 'required|integer|unique:personas,nuip',
            'telefono' => 'required|integer',
            'direccion' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre debe tener menos de 255 caracteres',
            'apellido.required' => 'El apellido es requerido',
            'apellido.string' => 'El apellido debe ser una cadena de texto',
            'apellido.max' => 'El apellido debe tener menos de 255 caracteres',
            'nuip.required' => 'El número de identificación es requerido',
            'nuip.integer' => 'El número de identificación debe ser un número',
            'nuip.unique' => 'El número de identificación ya existe',
            'telefono.required' => 'El celular es requerido',
            'telefono.integer' => 'El celular debe ser un número',
            'direccion.required' => 'La dirección es requerida',
            'direccion.string' => 'La dirección debe ser una cadena de texto',
            'direccion.max' => 'La dirección debe tener menos de 255 caracteres',
        ];
    }
}
