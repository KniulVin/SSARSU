<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constancia extends Model
{
    use HasFactory;

    protected $table = 'constancias';

    protected $fillable = [
        'codigo',
        'proyecto_id',
        'tipo',
        'archivo',
        'fecha_emision',
        'participante_id',
    ];

    // Opcional: valores permitidos para tipo
    public const TIPOS = [
        'participacion',
        'organizacion',
        'validacion',
        'aprobacion',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una constancia pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    // Una constancia pertenece a un participante
    public function participante()
    {
        return $this->belongsTo(Participante::class, 'participante_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Formatear fecha de emisión (ejemplo: dd/mm/yyyy)
    public function getFechaEmisionFormattedAttribute(): string
    {
        return \Carbon\Carbon::parse($this->fecha_emision)->format('d/m/Y');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por tipo de constancia
    public function scopeTipo($query, string $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    // Filtrar constancias emitidas en un rango de fechas
    public function scopeEmitidasEntre($query, string $inicio, string $fin)
    {
        return $query->whereBetween('fecha_emision', [$inicio, $fin]);
    }
}
