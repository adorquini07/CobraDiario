<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
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
            'id_persona' => 'required|exists:personas,id',
            'monto_prestado' => 'required|numeric|min:1',
            'cuota' => 'required|numeric|min:1',
            'fecha_prestamo' => 'required|date',
            'dias_apagar' => 'required|array|min:1',
            'dias_apagar.*' => 'required|string',
            'direccion' => 'required|string',
            'barrio' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'id_persona.required' => 'La persona es requerida',
            'id_persona.exists' => 'La persona no existe',
            'monto_prestado.required' => 'El monto prestado es requerido',
            'monto_prestado.numeric' => 'El monto prestado debe ser un número',
            'monto_prestado.min' => 'El monto prestado debe ser mayor a 0',
            'cuota.required' => 'La cuota es requerida',
            'cuota.numeric' => 'La cuota debe ser un número',
            'cuota.min' => 'La cuota debe ser mayor a 0',
            'fecha_prestamo.required' => 'La fecha de prestamo es requerida',
            'fecha_prestamo.date' => 'La fecha de prestamo debe ser una fecha válida',
            'dias_apagar.required' => 'Los días a pagar son requeridos',
            'dias_apagar.array' => 'Los días a pagar deben ser un array',
            'dias_apagar.*.required' => 'El día a pagar es requerido',
            'dias_apagar.*.string' => 'El día a pagar debe ser un string',
            'direccion.required' => 'La dirección es requerida',
            'direccion.string' => 'La dirección debe ser un string',
            'barrio.required' => 'El barrio es requerido',
            'barrio.string' => 'El barrio debe ser un string',
        ];
    }
}
