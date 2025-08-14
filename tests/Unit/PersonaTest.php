<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Persona;

class PersonaTest extends TestCase
{
    public function test_crear_persona()
    {
        $persona = new Persona([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'nuip' => '123456789',
            'telefono' => '3001234567',
            'direccion' => 'Calle 123'
        ]);

        $this->assertEquals('Juan', $persona->nombre);
        $this->assertEquals('Pérez', $persona->apellido);
        $this->assertEquals('123456789', $persona->nuip);
        $this->assertEquals('3001234567', $persona->telefono);
        $this->assertEquals('Calle 123', $persona->direccion);
    }

    public function test_campos_requeridos()
    {
        $persona = new Persona();
        $this->assertEmpty($persona->nombre);
        $this->assertEmpty($persona->apellido);
        $this->assertEmpty($persona->nuip);
        $this->assertEmpty($persona->telefono);
        $this->assertEmpty($persona->direccion);
    }

    public function test_tabla_personas()
    {
        $persona = new Persona();
        $this->assertEquals('personas', $persona->getTable());
    }

    public function test_campos_fillable()
    {
        $persona = new Persona();
        $fillable = ['nombre', 'apellido', 'nuip', 'telefono', 'direccion', 'barrio'];
        $this->assertEquals($fillable, $persona->getFillable());
    }
}
