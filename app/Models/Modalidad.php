<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;

    protected $table = 'modalidades';

    protected $fillable = [
        'nombre',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una modalidad puede estar asociada a varios proyectos
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'modalidad_id');
    }

    // Una modalidad puede tener diferentes transiciones de flujo
    public function transiciones()
    {
        return $this->hasMany(Transicion::class, 'modalidad_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por nombre de modalidad
    public function scopePorNombre($query, string $nombre)
    {
        return $query->where('nombre', 'like', "%$nombre%");
    }
}
