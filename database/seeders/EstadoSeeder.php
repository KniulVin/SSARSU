<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            [
                'nombre' => 'borrador',
                'descripcion' => 'Estado borrador',
            ],
            [
                'nombre' => 'en_revision',
                'descripcion' => 'Estado en_revision',
            ],
            [
                'nombre' => 'aprobado_facultad',
                'descripcion' => 'Estado aprobado_facultad',
            ],
            [
                'nombre' => 'aprobado_consejo',
                'descripcion' => 'Estado aprobado_consejo',
            ],
            [
                'nombre' => 'validado_ogrsu',
                'descripcion' => 'Estado validado_ogrsu',
            ],
            [
                'nombre' => 'finalizado',
                'descripcion' => 'Estado finalizado',
            ],
        ];

        foreach ($estados as $estado) {
            Estado::firstOrCreate(['nombre' => $estado['nombre']], $estado);
        }
    }
}
