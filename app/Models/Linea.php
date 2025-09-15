<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $table = 'lineas';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una línea puede tener varios proyectos asociados
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'linea_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por nombre de línea
    public function scopePorNombre($query, string $nombre)
    {
        return $query->where('nombre', 'like', "%$nombre%");
    }

    // Filtrar por coincidencia en la descripción
    public function scopePorDescripcion($query, string $texto)
    {
        return $query->where('descripcion', 'like', "%$texto%");
    }
}
