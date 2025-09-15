<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use Illuminate\Database\Seeder;

class ModalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modalidades = [
            [
                'nombre' => 'actividad_academica',
            ],
            [
                'nombre' => 'proyecto_multi',
            ],
            [
                'nombre' => 'proyecto_no_multi',
            ],
            [
                'nombre' => 'investigacion',
            ],
        ];

        foreach ($modalidades as $modalidad) {
            Modalidad::firstOrCreate(['nombre' => $modalidad['nombre']], $modalidad);
        }
    }
}
