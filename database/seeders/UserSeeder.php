<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los usuarios y asignarles roles
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Administrador'
            ],
            [
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Supervisor'
            ],
            [
                'name' => 'Regular User',
                'email' => 'usuario@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Usuario'
            ],
            [
                'name' => 'Regular User2',
                'email' => 'usuario2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'Usuario'
            ]
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password']
                ]
            );

            // Asignar el rol al usuario
            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
