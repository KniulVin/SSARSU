<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'plan_rsu',
                'descripcion' => 'Plan de responsabilidad social universitaria',
            ],
            [
                'nombre' => 'carta_conformidad',
                'descripcion' => 'Carta de conformidad de la entidad beneficiaria',
            ],
            [
                'nombre' => 'resolucion',
                'descripcion' => 'Resolución emitida por la facultad o consejo universitario',
            ],
            [
                'nombre' => 'cronograma',
                'descripcion' => 'Cronograma de ejecución del proyecto',
            ],
            [
                'nombre' => 'informe_avance',
                'descripcion' => 'Informe parcial o de avance del proyecto',
            ],
            [
                'nombre' => 'informe_final',
                'descripcion' => 'Informe final del proyecto de RSU',
            ],
            [
                'nombre' => 'evidencia',
                'descripcion' => 'Evidencias como fotos, videos o documentos de soporte',
            ],
            [
                'nombre' => 'otro',
                'descripcion' => 'Otro tipo de documento adicional',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nombre' => $categoria['nombre']], $categoria);
        }
    }
}
