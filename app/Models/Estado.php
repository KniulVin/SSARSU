<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = [
        'nombre',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Un estado puede estar asociado a muchos proyectos
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'estado_id');
    }

    // Un estado puede ser usado como origen en muchas transiciones
    public function transicionesOrigen()
    {
        return $this->hasMany(Transicion::class, 'estado_origen_id');
    }

    // Un estado puede ser usado como destino en muchas transiciones
    public function transicionesDestino()
    {
        return $this->hasMany(Transicion::class, 'estado_destino_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Buscar estado por nombre exacto
    public function scopePorNombre($query, string $nombre)
    {
        return $query->where('nombre', $nombre);
    }
}
