<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ====== 1. Crear permisos                                                 ======
        $actions = ['create', 'read', 'update', 'delete'];
        $entities = [
            'categories',
            'movies'
        ];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$entity}.{$action}"]);
            }
        }

        // ====== 2. Crear roles y asignar permisos                                 ======

        // Administrador: todos los permisos
        $administradorRole = Role::firstOrCreate(['name' => 'administrador']);
        $administradorRole->givePermissionTo(Permission::all());

        // Supervisor
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor']);

        // Ejecutor
        $ejecutorRole = Role::firstOrCreate(['name' => 'ejecutor']);

        // Organizador
        $organizadorRole = Role::firstOrCreate(['name' => 'organizador']);

        // ====== 3. Crear usuarios y asignar roles/permiso                         ======

        // Administrador
        $administrador = User::firstOrCreate(
            ['email' => 'administrador@example.com'],
            [
                'name' => 'Administrador User',
                'password' => Hash::make('12345678')
            ]
        );
        $administrador->assignRole($administradorRole);

        // Supervisor
        $supervisor = User::firstOrCreate(
            ['email' => 'supervisor@example.com'],
            [
                'name' => 'Supervisor User',
                'password' => Hash::make('12345678')
            ]
        );
        $supervisor->assignRole($supervisorRole);

        // Ejecutor
        $ejecutor = User::firstOrCreate(
            ['email' => 'ejecutor@example.com'],
            [
                'name' => 'Ejecutor User',
                'password' => Hash::make('12345678')
            ]
        );
        $ejecutor->assignRole($ejecutorRole);

        // Organizador
        $organizador = User::firstOrCreate(
            ['email' => 'organizador@example.com'],
            [
                'name' => 'Organizador User',
                'password' => Hash::make('12345678')
            ]
        );
        $organizador->assignRole($organizadorRole);


        // Usuario con permisos personalizados 1 (solo puede crear películas)
        $user1 = User::firstOrCreate(
            ['email' => 'special1@example.com'],
            [
                'name' => 'Special User 1',
                'password' => Hash::make('12345678')
            ]
        );
        $user1->givePermissionTo(['categories.create', 'categories.update']);

        // Usuario con permisos personalizados 2 (puede leer y borrar categorías)
        $user2 = User::firstOrCreate(
            ['email' => 'special2@example.com'],
            [
                'name' => 'Special User 2',
                'password' => Hash::make('12345678')
            ]
        );
        $user2->givePermissionTo(['categories.read', 'categories.delete']);
    }
}
