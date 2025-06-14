<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $nuip
 * @property string $email
 * @property string $telefono
 * @property string $direccion
 * @property string $created_at
 * @property string $updated_at
 */
class Persona extends Model
{
    protected $table = 'personas';
}
