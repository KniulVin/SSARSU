<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    use HasFactory;

    protected $table = 'indicadores';

    protected $fillable = [
        'nombre',
        'descripcion',
        'unidad',
        'proyecto_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Un indicador pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por nombre de indicador
    public function scopePorNombre($query, string $nombre)
    {
        return $query->where('nombre', 'like', "%$nombre%");
    }

    // Filtrar por unidad de medida
    public function scopePorUnidad($query, string $unidad)
    {
        return $query->where('unidad', $unidad);
    }
}
