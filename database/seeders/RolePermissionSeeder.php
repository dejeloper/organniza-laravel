<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los roles
        $roles = [
            'Administrador',
            'Supervisor',
            'Usuario'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Crear los permisos
        $permisosUsuarios = [
            'Ver usuarios',
            'Crear usuarios',
            'Editar usuarios',
            'Eliminar usuarios'
        ];

        $permisosLugares = [
            'Crear Lugares',
            'Ver Lugares',
            'Editar Lugares',
            'Eliminar Lugares'
        ];

        $permisos = array_merge($permisosUsuarios, $permisosLugares);

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Asignar permisos a los roles
        Role::where('name', 'Administrador')->first()->givePermissionTo(Permission::all());
        Role::where('name', 'Supervisor')->first()->givePermissionTo($permisosLugares);
        Role::where('name', 'Usuario')->first()->givePermissionTo(['Ver Lugares', 'Crear Lugares']);
    }
}
