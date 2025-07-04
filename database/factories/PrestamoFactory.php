<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestamo>
 */
class PrestamoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $diasApagar = fake()->randomElements($diasSemana, fake()->numberBetween(1, 3));
        
        $montoPrestado = fake()->randomFloat(2, 50000, 500000);
        $interes = 0.2; // 20% de interés
        $montoApagar = $montoPrestado + ($montoPrestado * $interes);
        $cuota = $montoApagar / count($diasApagar);

        return [
            'id_persona' => Persona::factory(),
            'monto_prestado' => $montoPrestado,
            'abonado' => 0,
            'monto_apagar' => $montoApagar,
            'cuota' => round($cuota, 2),
            'fecha_prestamo' => fake()->dateTimeBetween('-30 days', 'now'),
            'dias_apagar' => json_encode($diasApagar),
            'estado' => true,
            'direccion' => fake()->streetAddress(),
            'barrio' => fake()->randomElement([
                'La Soledad', 'San Cristóbal', 'El Centro', 'La Candelaria', 
                'Chapinero', 'Usaquén', 'Suba', 'Engativá', 'Fontibón', 
                'Kennedy', 'Bosa', 'Ciudad Bolívar', 'San Antonio', 'La Victoria',
                'Puente Aranda', 'Los Mártires', 'Rafael Uribe', 'Tunjuelito',
                'Barrios Unidos', 'Teusaquillo'
            ]),
        ];
    }

    /**
     * Indica que el préstamo está pagado
     */
    public function pagado(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => false,
            'abonado' => $attributes['monto_apagar'],
        ]);
    }

    /**
     * Indica que el préstamo está parcialmente pagado
     */
    public function parcialmentePagado(): static
    {
        return $this->state(fn (array $attributes) => [
            'abonado' => fake()->randomFloat(2, $attributes['cuota'], $attributes['monto_apagar'] - $attributes['cuota']),
        ]);
    }
} 