<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;

    protected $table = 'evidencias';

    protected $fillable = [
        'actividad_id',
        'tipo',
        'archivo',
        'descripcion',
    ];

    // Tipos de evidencia permitidos
    public const TIPOS = [
        'foto',
        'video',
        'documento',
        'enlace',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una evidencia pertenece a una actividad
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Construir URL pública del archivo (ejemplo usando storage)
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->archivo);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por tipo de evidencia
    public function scopeTipo($query, string $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Filtrar evidencias de tipo multimedia (foto o video)
    public function scopeMultimedia($query)
    {
        return $query->whereIn('tipo', ['foto', 'video']);
    }
}
