<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Una categoría puede tener muchos documentos
    public function documentos()
    {
        return $this->hasMany(Documento::class, 'categoria_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Buscar categoría por nombre exacto
    public function scopePorNombre($query, string $nombre)
    {
        return $query->where('nombre', $nombre);
    }

    // Buscar categorías que contengan texto en nombre o descripción
    public function scopeBuscar($query, string $term)
    {
        return $query->where('nombre', 'like', "%$term%")
            ->orWhere('descripcion', 'like', "%$term%");
    }
}
