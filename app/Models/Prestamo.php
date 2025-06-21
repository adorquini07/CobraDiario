<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_persona
 * @property double $monto_prestado
 * @property double $abonado
 * @property double $monto_apagar
 * @property double $cuota
 * @property string $fecha_prestamo
 * @property string $dias_apagar
 * @property boolean $estado
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Persona $persona
 * @property Pago[] $pagos
 *
 * @property string $dias_apagar
 */
class Prestamo extends Model
{
    public const INTERES = 0.2;
    protected $table = 'prestamos';

    protected $fillable = ['id_persona', 'monto_prestado', 'abonado', 'monto_apagar', 'cuota', 'fecha_prestamo', 'dias_apagar', 'estado'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_prestamo', 'id');
    }

    public function guardarPrestamo()
    {
        $this->monto_apagar = ($this->monto_prestado * self::INTERES) + $this->monto_prestado;
        $this->estado = true;
        $this->dias_apagar = json_encode($this->dias_apagar);
        assert($this->save());
        return true;
    }

    public function diasApagar()
    {
        $dias = json_decode($this->dias_apagar);
        if (count($dias) == 7) {
            return 'Todos los días';
        }
        return implode(', ', $dias);
    }
    public static function crearPago(array $data = [])
    {
        $pago = new Pago();
        $pago->fill($data);
        assert($pago->save(), 'Error al crear el pago');
        $pago->refresh();
        $pago->prestamo->abonado += $pago->monto_pagado;
        if ($pago->prestamo->abonado == $pago->prestamo->monto_apagar) {
            $pago->prestamo->estado = false;
        }
        $pago->prestamo->save();
        return $pago;
    }
}
