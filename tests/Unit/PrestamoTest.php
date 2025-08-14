<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Prestamo;
use App\Models\Persona;
use App\Models\Pago;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrestamoTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_prestamo()
    {
        $persona = Persona::factory()->create();
        
        $prestamo = new Prestamo([
            'id_persona' => $persona->id,
            'monto_prestado' => 100000,
            'cuota' => 20000,
            'fecha_prestamo' => now(),
            'dias_apagar' => ['Lunes', 'Martes'],
            'direccion' => 'Calle 123',
            'barrio' => 'Centro',
            'numeracion' => 1
        ]);
        $prestamo->guardarPrestamo();
        $this->assertEquals(100000, $prestamo->monto_prestado);
        $this->assertEquals(20000, $prestamo->cuota);
        $this->assertTrue($prestamo->estado);
    }

    public function test_calcular_monto_a_pagar()
    {
        $persona = Persona::factory()->create();
        
        $prestamo = new Prestamo([
            'id_persona' => $persona->id,
            'monto_prestado' => 100000,
            'cuota' => 20000,
            'fecha_prestamo' => now(),
            'dias_apagar' => ['Lunes'],
            'direccion' => 'Calle 123',
            'barrio' => 'Centro',
            'numeracion' => 1
        ]);

        $prestamo->guardarPrestamo();
        
        // 100000 + (100000 * 0.2) = 120000
        $this->assertEquals(120000, $prestamo->monto_apagar);
    }

    public function test_relacion_con_persona()
    {
        $persona = Persona::factory()->create();
        $prestamo = Prestamo::factory()->create(['id_persona' => $persona->id]);

        $this->assertInstanceOf(Persona::class, $prestamo->persona);
        $this->assertEquals($persona->id, $prestamo->persona->id);
    }

    public function test_relacion_con_pagos()
    {
        $persona = Persona::factory()->create();
        $prestamo = Prestamo::factory()->create(['id_persona' => $persona->id]);
        $pago = new Pago([
            'id_prestamo' => $prestamo->id,
            'id_persona' => $persona->id,
            'monto_pagado' => 20000,
            'fecha_pago' => now()
        ]);
        $this->assertTrue($pago->save());

        $this->assertCount(1, $prestamo->pagos);
        $this->assertInstanceOf(Pago::class, $prestamo->pagos->first());
    }

    public function test_dias_apagar_formato()
    {
        $persona = Persona::factory()->create();
        
        $prestamo = new Prestamo([
            'id_persona' => $persona->id,
            'monto_prestado' => 100000,
            'cuota' => 20000,
            'fecha_prestamo' => now(),
            'dias_apagar' => ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            'direccion' => 'Calle 123',
            'barrio' => 'Centro',
            'numeracion' => 1
        ]);

        $prestamo->guardarPrestamo();
        
        $this->assertEquals('Todos los días', $prestamo->diasApagar());
    }

    public function test_crear_pago()
    {
        $persona = Persona::factory()->create();
        $prestamo = Prestamo::factory()->create([
            'id_persona' => $persona->id,
            'monto_prestado' => 100000,
            'monto_apagar' => 120000,
            'abonado' => 0
        ]);

        $pago = Prestamo::crearPago([
            'id_prestamo' => $prestamo->id,
            'id_persona' => $persona->id,
            'monto_pagado' => 20000,
            'fecha_pago' => now()
        ]);

        $this->assertInstanceOf(Pago::class, $pago);
        $this->assertEquals(20000, $prestamo->fresh()->abonado);
    }
}
