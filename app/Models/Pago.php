<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_prestamo
 * @property int $id_persona
 * @property float $monto_pagado
 * @property string $fecha_pago
 * @property string $created_at
 * @property string $updated_at
 *
 *
 * @property Prestamo $prestamo
 * @property Persona $persona
 */
class Pago extends Model
{
    protected $table = 'pagos';
    protected $fillable = ['id_prestamo', 'id_persona', 'monto_pagado', 'fecha_pago'];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'id_prestamo');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
