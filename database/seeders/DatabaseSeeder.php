<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CarSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=>'wefwefwe345345',
        ]);

        $this->call(CarSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(CarboyTypeSeeder::class);
        $this->call(CarboySeeder::class);

    }
}
