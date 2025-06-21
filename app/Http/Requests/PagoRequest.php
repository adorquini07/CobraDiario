<?php

namespace App\Http\Requests;

use App\Models\Prestamo;
use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
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
            'id_prestamo' => 'required|exists:prestamos,id',
            'id_persona' => 'required|exists:personas,id',
            'monto_pagado' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $prestamo =Prestamo::find($this->id_prestamo);
    
                    if ($prestamo) {
                        $nuevoTotal = $prestamo->abonado + $value;
    
                        if ($nuevoTotal > $prestamo->monto_apagar) {
                            $restante = $prestamo->monto_apagar - $prestamo->abonado;
                            $fail("El monto abonado excede el valor a pagar. Solo puedes abonar máximo: $restante.");
                        }
                    }
                }
            ],
            'fecha_pago' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'id_prestamo.required' => 'El id del prestamo es requerido',
            'id_prestamo.exists' => 'El id del prestamo no existe',
            'id_persona.required' => 'El id de la persona es requerido',
            'id_persona.exists' => 'El id de la persona no existe',
            'cuota.required' => 'La cuota es requerida',
            'cuota.exists' => 'La cuota no existe',
            'monto_pagado.required' => 'El monto pagado es requerido',
            'fecha_pago.required' => 'La fecha de pago es requerida',
            'fecha_pago.date' => 'La fecha de pago debe ser una fecha válida',
            'monto_pagado.numeric' => 'El monto pagado debe ser un número',
            'monto_pagado.min' => 'El monto pagado debe ser mayor a 0',
        ];
    }
}
