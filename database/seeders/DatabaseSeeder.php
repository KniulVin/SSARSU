<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategoriaSeeder::class,
            LineaSeeder::class,
            ModalidadSeeder::class,
            TransicionSeeder::class,
            EstadoSeeder::class,
            FacultadSeeder::class,
        ]);
    }
}
