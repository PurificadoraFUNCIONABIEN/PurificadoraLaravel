<?php

namespace Database\Seeders;

use App\Models\Carboy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarboySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Carboy::create([
            'state' => 'nuevo',
            'color' => 'rojo',
            'cantidad'=>15.7,
            'img'=>'botes/fkpkGjbDl8.png',
            'carboyType_id'=>2,

        ]);

        Carboy::create([
            'state' => 'roto',
            'color' => 'verde',
            'cantidad'=>22.4,
            'img'=>'botes/fkpkGjbDl8.png',
            'carboyType_id'=>1,
        ]);
    }
}
