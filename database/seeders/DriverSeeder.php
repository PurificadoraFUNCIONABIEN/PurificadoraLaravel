<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Driver::create([
            'name' => 'Alan Romeo Domiguez',
            'license' => '122334345'
        ]);

        Driver::create([
            'name' => 'Luis Felipe Ramirez Arreortua',
            'license' => '1223434345'
            
        ]);
    }
}
