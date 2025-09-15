<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'proyecto_id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'responsable_id',
        'estado',
    ];

    // Opcional: valores permitidos en estado
    public const ESTADOS = [
        'pendiente',
        'en_ejecucion',
        'completada',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una actividad pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    // Una actividad tiene un responsable (usuario)
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // Una actividad puede tener muchas evidencias
    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'actividad_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors / Mutators
    |--------------------------------------------------------------------------
    */

    // Ejemplo: devolver estado capitalizado
    public function getEstadoLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->estado));
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar actividades por estado
    public function scopeEstado($query, string $estado)
    {
        return $query->where('estado', $estado);
    }

    // Filtrar actividades en curso
    public function scopeEnEjecucion($query)
    {
        return $query->where('estado', 'en_ejecucion');
    }

    // Filtrar actividades pendientes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    // Filtrar actividades completadas
    public function scopeCompletadas($query)
    {
        return $query->where('estado', 'completada');
    }
}
