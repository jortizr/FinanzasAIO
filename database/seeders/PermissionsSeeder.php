<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //creacion de permisos

        Permission::creacte(['name' => 'Eliminar']);
        Permission::creacte(['name' => 'Crear']);
        Permission::creacte(['name' => 'Actualizar']);

        $Admin = Role::create(['name' => 'Administrador']);
        $Admin->getAllPermissions();

        $user = Role::create(['name' => 'Usuario']);
        $user->givePermissionTo(['Crear', 'Actualizar', 'Eliminar']);
    }
}
