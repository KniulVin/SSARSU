<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;

    protected $table = 'objetivos';

    protected $fillable = [
        'tipo', // general o especifico
        'descripcion',
        'proyectos_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Un objetivo pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectos_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar solo objetivos generales
    public function scopeGenerales($query)
    {
        return $query->where('tipo', 'general');
    }

    // Filtrar solo objetivos específicos
    public function scopeEspecificos($query)
    {
        return $query->where('tipo', 'especifico');
    }
}
