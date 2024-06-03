<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Permisos para el administrador
          Permission::create(['name' => 'add cars']);
          Permission::create(['name' => 'add routes']);
          Permission::create(['name' => 'delete routes']);
          Permission::create(['name' => 'add products']);
          Permission::create(['name' => 'edit products']);
          Permission::create(['name' => 'delete products']);
  
          // Permisos para el conductor
          Permission::create(['name' => 'edit cars']);
          Permission::create(['name' => 'view routes']);
    }
}
