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
            'name' => 'Luis Felipe Ramirez Arreortua',
            'email' => 'felipe_ramirez1234@hotmail.com',
            'password' => bcrypt('12345678'), // Aquí deberías usar la contraseña adecuada
        ]);

        // Obtener el rol "admin"
        $adminRole = Role::where('name', 'admin')->first();

        // Asignar el rol al usuario
        $user->roles()->attach($adminRole);
    }
}
