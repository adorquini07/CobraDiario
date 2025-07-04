<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $barrios = [
            'La Soledad', 'San Cristóbal', 'El Centro', 'La Candelaria', 
            'Chapinero', 'Usaquén', 'Suba', 'Engativá', 'Fontibón', 
            'Kennedy', 'Bosa', 'Ciudad Bolívar', 'San Antonio', 'La Victoria',
            'Puente Aranda', 'Los Mártires', 'Rafael Uribe', 'Tunjuelito',
            'Barrios Unidos', 'Teusaquillo'
        ];

        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'nuip' => fake()->unique()->numberBetween(10000000, 99999999),
            'telefono' => fake()->numerify('3########'),
            'direccion' => fake()->streetAddress(),
            'barrio' => fake()->randomElement($barrios),
        ];
    }
} 