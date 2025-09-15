<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transicion extends Model
{
    use HasFactory;

    protected $table = 'transiciones';

    protected $fillable = [
        'estado_origen',
        'estado_destino',
        'rol_requerido',
        'permiso_requerido',
        'modalidad_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una transición está asociada a una modalidad
    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'modalidad_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos de utilidad
    |--------------------------------------------------------------------------
    */

    // Verificar si un usuario con cierto rol puede ejecutar esta transición
    public function puedeEjecutar($rolUsuario, $permisosUsuario)
    {
        return $this->rol_requerido === $rolUsuario &&
            in_array($this->permiso_requerido, $permisosUsuario);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar transiciones por estado de origen
    public function scopeDesdeEstado($query, $estado)
    {
        return $query->where('estado_origen', $estado);
    }

    // Filtrar transiciones por estado de destino
    public function scopeHaciaEstado($query, $estado)
    {
        return $query->where('estado_destino', $estado);
    }
}
