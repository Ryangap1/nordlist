<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear o actualizar el usuario administrador
        $user = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Ryan', 'password' => bcrypt('password')]
        );

        // Crear el rol de administrador (si no existe)
        $rol = Role::firstOrCreate(['name' => 'administrador']);

        // Obtener todos los permisos existentes
        $permisos = Permission::pluck('id', 'id')->all();

        // Asignar todos los permisos al rol administrador
        $rol->syncPermissions($permisos);

        // Asignar el rol al usuario
        $user->assignRole($rol);
    }
}
