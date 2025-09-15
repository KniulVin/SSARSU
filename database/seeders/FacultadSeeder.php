<?php

namespace Database\Seeders;

use App\Models\Facultad;
use Illuminate\Database\Seeder;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facultades = [
            ['nombre' => 'Facultad de Ciencias', 'tiene_unidad_rsu' => 1],
            ['nombre' => 'Facultad de Ingeniería', 'tiene_unidad_rsu' => 1],
            ['nombre' => 'Facultad de Ciencias de la Salud', 'tiene_unidad_rsu' => 1],
            ['nombre' => 'Facultad de Ciencias Sociales y Humanidades', 'tiene_unidad_rsu' => 0],
            ['nombre' => 'Facultad de Ciencias Económicas y Administrativas', 'tiene_unidad_rsu' => 1],
            ['nombre' => 'Facultad de Derecho y Ciencias Políticas', 'tiene_unidad_rsu' => 0],
        ];

        foreach ($facultades as $facultad) {
            Facultad::firstOrCreate(
                ['nombre' => $facultad['nombre']],
                [
                    'tiene_unidad_rsu' => $facultad['tiene_unidad_rsu'],
                    'jefe_rsu' => null, // asignar luego a un usuario
                ]
            );
        }
    }
}
