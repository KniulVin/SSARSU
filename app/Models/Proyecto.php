<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'codigo',
        'titulo',
        'descripcion',
        'entidad_beneficiaria',
        'es_multidisciplinario',
        'fecha_inicio',
        'fecha_fin',
        'fecha_presentacion',
        'fecha_aprobacion',
        'created_by',
        'modalidad_id',
        'estado_id',
        'linea_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Usuario que creó el proyecto
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Modalidad (actividad académica, investigación, proyecto multi, etc.)
    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'modalidad_id');
    }

    // Estado actual del proyecto (borrador, en revisión, aprobado, etc.)
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    // Línea de RSU asociada
    public function linea()
    {
        return $this->belongsTo(Linea::class, 'linea_id');
    }

    // Objetivos del proyecto
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class, 'proyectos_id');
    }

    // Documentos relacionados al proyecto
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'proyecto_id');
    }

    // Actividades dentro del proyecto
    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'proyecto_id');
    }

    // Participantes del proyecto
    public function participantes()
    {
        return $this->hasMany(Participante::class, 'proyecto_id');
    }

    // Constancias emitidas para los participantes del proyecto
    public function constancias()
    {
        return $this->hasMany(Constancia::class, 'proyecto_id');
    }

    // Indicadores de evaluación del proyecto
    public function indicadores()
    {
        return $this->hasMany(Indicador::class, 'proyecto_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar proyectos por estado
    public function scopePorEstado($query, $estadoId)
    {
        return $query->where('estado_id', $estadoId);
    }

    // Filtrar proyectos por modalidad
    public function scopePorModalidad($query, $modalidadId)
    {
        return $query->where('modalidad_id', $modalidadId);
    }

    // Buscar proyectos por título o código
    public function scopeBuscar($query, $term)
    {
        return $query->where('titulo', 'like', "%{$term}%")
            ->orWhere('codigo', 'like', "%{$term}%");
    }
}
