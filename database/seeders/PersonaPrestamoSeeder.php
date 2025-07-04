<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\Prestamo;
use Illuminate\Database\Seeder;

class PersonaPrestamoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 20 personas
        $personas = Persona::factory(20)->create();
        
        // Crear 10 préstamos usando personas existentes
        $personasIds = $personas->pluck('id')->toArray();
        
        for ($i = 0; $i < 10; $i++) {
            $personaId = fake()->randomElement($personasIds);
            
            Prestamo::factory()->create([
                'id_persona' => $personaId,
            ]);
        }
        
        // Crear algunos préstamos pagados y parcialmente pagados para variedad
        Prestamo::factory(3)->pagado()->create([
            'id_persona' => fake()->randomElement($personasIds),
        ]);
        
        Prestamo::factory(2)->parcialmentePagado()->create([
            'id_persona' => fake()->randomElement($personasIds),
        ]);
        
        $this->command->info('✅ Se crearon 20 personas y 15 préstamos de ejemplo');
    }
} 