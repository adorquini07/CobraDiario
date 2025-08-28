<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonaRequest extends FormRequest
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
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'nuip' => 'required|integer',
            'direccion' => 'required|string|max:255',
            'barrio' => 'required|string|max:255',
            'telefono' => 'required|integer|digits:10',
            'estado' => 'required|in:0,1',
        ];

        // Si el estado es inactivo (0), las observaciones son requeridas
        if ($this->input('estado') == 0) {
            $rules['observaciones'] = 'required|string|max:1000';
        } else {
            $rules['observaciones'] = 'nullable|string|max:1000';
        }

        return $rules;
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
            'telefono.required' => 'El celular es requerido',
            'telefono.integer' => 'El celular debe ser un número',
            'telefono.digits' => 'El celular debe tener 10 dígitos',
            'direccion.required' => 'La dirección es requerida',
            'direccion.string' => 'La dirección debe ser una cadena de texto',
            'direccion.max' => 'La dirección debe tener menos de 255 caracteres',
            'barrio.required' => 'El barrio es requerido',
            'barrio.string' => 'El barrio debe ser una cadena de texto',
            'barrio.max' => 'El barrio debe tener menos de 255 caracteres',
            'estado.required' => 'El estado es requerido',
            'estado.in' => 'El estado debe ser activo o inactivo',
            'observaciones.required' => 'Las observaciones son requeridas cuando el estado es inactivo',
            'observaciones.string' => 'Las observaciones deben ser una cadena de texto',
            'observaciones.max' => 'Las observaciones deben tener menos de 1000 caracteres',
        ];
    }
}
