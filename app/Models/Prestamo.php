<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_persona
 * @property double $monto_prestado
 * @property double $monto_apagar
 * @property double $cuota
 * @property string $fecha_prestamo
 * @property string $dias_apagar
 * @property boolean $estado
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Persona $persona
 */
class Prestamo extends Model
{
    protected $table = 'prestamos';

    protected $fillable = ['id_persona', 'monto_prestado', 'monto_apagar', 'cuota', 'fecha_prestamo', 'dias_apagar', 'estado'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id');
    }

    public function guardarPrestamo()
    {
        $this->monto_apagar = ($this->monto_prestado * 0.2) + $this->monto_prestado;
        $this->estado = true;
        $this->dias_apagar = json_encode($this->dias_apagar);
        assert($this->save());
        return true;
    }

    public function diasApagar()
    {
        $dias = json_decode($this->dias_apagar);
        return implode(', ', $dias);
    }
}
