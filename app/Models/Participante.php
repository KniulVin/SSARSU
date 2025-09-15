<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $fillable = [
        'rol',          // ejecutor, colaborador, asesor, responsable
        'proyecto_id',
        'user_id',
        'facultad_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Un participante pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    // Un participante pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Un participante está asociado a una facultad
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }

    // Un participante puede tener varias constancias
    public function constancias()
    {
        return $this->hasMany(Constancia::class, 'participante_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por rol
    public function scopePorRol($query, $rol)
    {
        return $query->where('rol', $rol);
    }
}
