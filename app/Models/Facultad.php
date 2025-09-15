<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultades';

    protected $fillable = [
        'nombre',
        'tiene_unidad_rsu',
        'jefe_rsu',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una facultad puede tener un jefe RSU (usuario)
    public function jefe()
    {
        return $this->belongsTo(User::class, 'jefe_rsu');
    }

    // Una facultad puede tener muchos participantes en proyectos
    public function participantes()
    {
        return $this->hasMany(Participante::class, 'facultad_id');
    }

    // Una facultad puede estar relacionada a muchos proyectos a través de participantes
    public function proyectos()
    {
        return $this->hasManyThrough(
            Proyecto::class,
            Participante::class,
            'facultad_id',   // FK en participantes
            'id',            // FK en proyectos
            'id',            // PK en facultades
            'proyecto_id'    // FK en participantes
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Facultades que tienen unidad de RSU activa
    public function scopeConUnidadRsu($query)
    {
        return $query->where('tiene_unidad_rsu', true);
    }

    // Facultades que no tienen unidad de RSU
    public function scopeSinUnidadRsu($query)
    {
        return $query->where('tiene_unidad_rsu', false);
    }
}
