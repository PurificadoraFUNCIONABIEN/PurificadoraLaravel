<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        $estados = ['atendido', 'en espera', 'en camino'];
        return [
            'fechaPedido' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'cantidadLitros' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 99999.99),
            'estado' => $faker->randomElement($estados)
        ];
    }
}
