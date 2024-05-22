<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear registros de ejemplo
        Car::create([
            'capacity' => 1.6,
            'model' => 'Toyota Corolla'
        ]);

        Car::create([
            'capacity' => 2.0,
            'model' => 'Honda Civic'
        ]);
    }
}
