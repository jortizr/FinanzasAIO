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
        Permission::create(['name' => 'currency.show']);
        Permission::create(['name' => 'currency.create']);
        Permission::create(['name' => 'currency.update']);
        Permission::create(['name' => 'currency.delete']);

        $Admin = Role::create(['name' => 'Administrador']);
        $Admin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'Usuario']);
        $user->givePermissionTo(['Crear', 'Actualizar', 'Eliminar']);
    }
}
