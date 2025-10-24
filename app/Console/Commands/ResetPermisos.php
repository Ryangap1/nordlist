<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class ResetPermisos extends Command
{
    /**
     * El nombre y firma del comando de Artisan.
     *
     * @var string
     */
    protected $signature = 'permisos:reset';

    /**
     * La descripción del comando.
     *
     * @var string
     */
    protected $description = 'Reinicia los permisos y roles del sistema usando el PermissionSeeder';

    /**
     * Ejecuta el comando.
     */
    public function handle()
    {
        $this->info('Reiniciando permisos y roles...');

        // Desactivar claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ejecutar el seeder de permisos
        Artisan::call('db:seed', [
            '--class' => 'PermissionSeeder',
        ]);

        $this->info('✅ Permisos y roles reiniciados correctamente.');
    }
}
