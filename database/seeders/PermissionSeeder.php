<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //CATEGORIAS
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'eliminar-categoria',

            //CLIENTES
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'eliminar-cliente',

            //COMPRAS
            'ver-compra',
            'crear-compra',
            'mostrar-compra',
            'eliminar-compra',

            //MARCAS
            'ver-marca',
            'crear-marca',
            'editar-marca',
            'eliminar-marca',

            //PRESENTACIONES
            'ver-presentacion',
            'crear-presentacion',
            'editar-presentacion',
            'eliminar-presentacion',

            //PRODUCTOS
            'ver-producto',
            'crear-producto',
            'editar-producto',
            'eliminar-producto',

            //PROVEEDORES
            'ver-proveedor',
            'crear-proveedor',
            'editar-proveedor',
            'eliminar-proveedor',

            //VENTAS
            'ver-venta',
            'crear-venta',
            'mostrar-venta',
            'eliminar-venta',

            //ROLES
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',

            //USERS
            'ver-user',
            'crear-user',
            'editar-user',
            'eliminar-user',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();

        Permission::truncate();
        Role::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach($permisos as $permiso){
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }
    }
}
