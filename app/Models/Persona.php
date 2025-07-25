<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $nuip
 * @property string $telefono
 * @property string $direccion
 * @property string $barrio
 * @property string $created_at
 * @property string $updated_at
 */
class Persona extends Model
{
    use HasFactory;
    
    protected $table = 'personas';

    protected $fillable = ['nombre', 'apellido', 'nuip', 'telefono', 'direccion', 'barrio'];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_persona', 'id');
    }
}
