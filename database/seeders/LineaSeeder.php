<?php

namespace Database\Seeders;

use App\Models\Linea;
use Illuminate\Database\Seeder;

class LineaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lineas = [
            [
                'nombre' => 'Medio ambiente y sostenibilidad',
                'descripcion' => 'Proyectos orientados a la preservación del medio ambiente, manejo de residuos y uso sostenible de recursos.',
            ],
            [
                'nombre' => 'Inclusión social y equidad',
                'descripcion' => 'Actividades que promueven la inclusión, equidad y participación de poblaciones vulnerables.',
            ],
            [
                'nombre' => 'Salud y bienestar',
                'descripcion' => 'Proyectos vinculados a la promoción de la salud física y mental en la comunidad.',
            ],
            [
                'nombre' => 'Educación y cultura',
                'descripcion' => 'Iniciativas orientadas a mejorar la calidad educativa, acceso a la educación y difusión cultural.',
            ],
            [
                'nombre' => 'Desarrollo económico y productivo',
                'descripcion' => 'Actividades que fomentan el emprendimiento, la innovación y el desarrollo sostenible de comunidades.',
            ],
        ];

        foreach ($lineas as $linea) {
            Linea::firstOrCreate(['nombre' => $linea['nombre']], $linea);
        }
    }
}
