<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'tes3t',
            'email' => 'tes3t@example.com',
            'password' => bcrypt('1234567'), // Aquí deberías usar la contraseña adecuada
        ]);

        // Obtener el rol "admin"
        $adminRole = Role::where('name', 'admin')->first();

        // Asignar el rol al usuario
        $user->roles()->attach($adminRole);
    }
}
