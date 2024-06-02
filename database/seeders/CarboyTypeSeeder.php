<?php

namespace Database\Seeders;

use App\Models\CarboyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarboyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CarboyType::create([
            'capacity' => 15.7,
            'price' => 12.3,
        ]);

        CarboyType::create([
            'capacity' => 13.6,
            'price' => 9.6,
        ]);
    }
}
