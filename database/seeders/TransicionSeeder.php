<?php

namespace Database\Seeders;

use App\Models\Transicion;
use Illuminate\Database\Seeder;

class TransicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transiciones = [
            // -- ========================================================================
            // -- 1. ACTIVIDADES ACADÉMICAS DE RSU *(actividad_academica 1)
            // -- Flujo: borrador → en_revision → aprobado_facultad → validado_ogrsu → finalizado
            // -- ========================================================================
            [
                'estado_origen' => 'borrador',
                'estado_destino' => 'en_revision',
                'rol_requerido' => 'docente',
                'permiso_requerido' => 'crear_proyecto',
                'modalidad_id'    => 1,
            ],
            [
                'estado_origen' => 'en_revision',
                'estado_destino' => 'aprobado_facultad',
                'rol_requerido' => 'jefe_rsu_facultad',
                'permiso_requerido' => 'aprobar_proyecto',
                'modalidad_id'    => 1,
            ],
            [
                'estado_origen' => 'aprobado_facultad',
                'estado_destino' => 'validado_ogrsu',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'validar_proyecto',
                'modalidad_id'    => 1,
            ],
            [
                'estado_origen' => 'validado_ogrsu',
                'estado_destino' => 'finalizado',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'cerrar_proyecto',
                'modalidad_id'    => 1,
            ],

            // -- ========================================================================
            // -- 2. PROYECTOS MULTIDISCIPLINARIOS *(proyecto_multi 2)
            // -- Flujo: borrador → en_revision → aprobado_facultad → aprobado_consejo → validado_ogrsu → finalizado
            // -- ========================================================================
            [
                'estado_origen' => 'borrador',
                'estado_destino' => 'en_revision',
                'rol_requerido' => 'docente',
                'permiso_requerido' => 'crear_proyecto',
                'modalidad_id' => 2,
            ],
            [
                'estado_origen' => 'en_revision',
                'estado_destino' => 'aprobado_facultad',
                'rol_requerido' => 'jefe_rsu_facultad',
                'permiso_requerido' => 'aprobar_proyecto',
                'modalidad_id' => 2,
            ],
            [
                'estado_origen' => 'aprobado_facultad',
                'estado_destino' => 'aprobado_consejo',
                'rol_requerido' => 'consejo_universitario',
                'permiso_requerido' => 'emitir_resolucion',
                'modalidad_id' => 2,
            ],
            [
                'estado_origen' => 'aprobado_consejo',
                'estado_destino' => 'validado_ogrsu',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'validar_proyecto',
                'modalidad_id' => 2,
            ],
            [
                'estado_origen' => 'validado_ogrsu',
                'estado_destino' => 'finalizado',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'cerrar_proyecto',
                'modalidad_id' => 2,
            ],

            // -- ========================================================================
            // -- 3. PROYECTOS NO MULTIDISCIPLINARIOS *(proyecto_no_multi 3)
            // -- Flujo: borrador → en_revision → aprobado_facultad → validado_ogrsu → finalizado
            // -- ========================================================================
            [
                'estado_origen' => 'borrador',
                'estado_destino' => 'en_revision',
                'rol_requerido' => 'docente',
                'permiso_requerido' => 'crear_proyecto',
                'modalidad_id' => 3,
            ],
            [
                'estado_origen' => 'en_revision',
                'estado_destino' => 'aprobado_facultad',
                'rol_requerido' => 'jefe_rsu_facultad',
                'permiso_requerido' => 'aprobar_proyecto',
                'modalidad_id' => 3,
            ],
            [
                'estado_origen' => 'aprobado_facultad',
                'estado_destino' => 'validado_ogrsu',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'validar_proyecto',
                'modalidad_id' => 3,
            ],
            [
                'estado_origen' => 'validado_ogrsu',
                'estado_destino' => 'finalizado',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'cerrar_proyecto',
                'modalidad_id' => 3,
            ],
            // -- ========================================================================
            // -- 4. INVESTIGACIONES CON ENFOQUE SOCIAL *(investigacion 4)
            // -- Flujo: borrador → en_revision → aprobado_facultad → aprobado_consejo → validado_ogrsu → finalizado
            // -- ========================================================================
            [
                'estado_origen' => 'borrador',
                'estado_destino' => 'en_revision',
                'rol_requerido' => 'docente',
                'permiso_requerido' => 'crear_proyecto',
                'modalidad_id' => 4,
            ],
            [
                'estado_origen' => 'en_revision',
                'estado_destino' => 'aprobado_facultad',
                'rol_requerido' => 'jefe_rsu_facultad',
                'permiso_requerido' => 'aprobar_proyecto',
                'modalidad_id' => 4,
            ],
            [
                'estado_origen' => 'aprobado_facultad',
                'estado_destino' => 'aprobado_consejo',
                'rol_requerido' => 'vicerrectorado',
                'permiso_requerido' => 'aprobar_investigacion',
                'modalidad_id' => 4,
            ],
            [
                'estado_origen' => 'aprobado_consejo',
                'estado_destino' => 'validado_ogrsu',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'validar_proyecto',
                'modalidad_id' => 4,
            ],
            [
                'estado_origen' => 'validado_ogrsu',
                'estado_destino' => 'finalizado',
                'rol_requerido' => 'ogrsu',
                'permiso_requerido' => 'cerrar_proyecto',
                'modalidad_id' => 4,
            ],
        ];

        foreach ($transiciones as $t) {
            Transicion::firstOrCreate([
                'estado_origen'   => $t['estado_origen'],
                'estado_destino'  => $t['estado_destino'],
                'rol_requerido'   => $t['rol_requerido'],
                'permiso_requerido' => $t['permiso_requerido'],
                'modalidad_id'    => $t['modalidad_id'],
            ]);
        }
    }
}
