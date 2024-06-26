<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CarSeeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);

        $adminRole = Role::findByName('admin');
        $adminRole->syncPermissions([
            'add cars', 'add routes', 'delete routes', 'add products', 'edit products', 'delete products'
        ]);

        $conductorRole = Role::findByName('conductor');
        $conductorRole->syncPermissions([
            'edit cars', 'view routes'
        ]);
        $this->call(CarboyTypeSeeder::class);
        $this->call(CarboySeeder::class);
        $this->call(CarboyOrderSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(UserSeeder::class);











    }
}
