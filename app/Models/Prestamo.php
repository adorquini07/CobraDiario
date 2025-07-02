<?php

namespace App\Models;

use Carbon\Carbon;
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
 * @property int $RecogerHoy
 * @property int $CobrarHoy
 * @property boolean $pagoHoy
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
        if (count($dias) == 6) {
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

    public static function CobrarHoy()
    {
        $diaActual = Carbon::now()->locale('es')->dayName;
        $diaActual = ucfirst($diaActual);

        return self::whereRaw('JSON_CONTAINS(dias_apagar, ?)', ['["' . $diaActual . '"]'])
            ->where('estado', true)
            ->whereDoesntHave('pagos', function ($query) {
                $query->whereDate('fecha_pago', Carbon::today());
            })
            ->with(['persona' => function ($query) {
                $query->orderBy('barrio');
            }])
            ->get()
            ->sortBy('persona.barrio');
    }

    public static function RecogerHoy(): int
    {
        $prestamos = self::CobrarHoy();

        $coutas = 0;
        foreach ($prestamos as $prestamo) {
            $coutas += $prestamo->cuota;
        }

        return $coutas;
    }

    public function getPagoHoy()
    {
        return Pago::where('id_prestamo', $this->id)->where('fecha_pago', date('Y-m-d'))->exists();
    }
}
