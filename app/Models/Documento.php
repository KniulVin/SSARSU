<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'nombre',
        'nombre_original',
        'ruta',
        'size',
        'mime_type',
        'titulo',
        'descripcion',
        'es_obligatorio',
        'fecha_documento',
        'estado',
        'observaciones',
        'uploaded_at',
        'reviewed_at',
        'proyecto_id',
        'uploaded_by',
        'categoria_id',
    ];

    // Estados posibles del documento
    public const ESTADOS = [
        'en_revision',
        'pendiente',
        'revisado',
        'aprobado',
        'observado',
        'rechazado',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    // Documento pertenece a un proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    // Documento pertenece a un usuario (quien lo subió)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Documento pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Ruta completa del archivo (ejemplo con storage)
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->ruta);
    }

    // Nombre legible del estado
    public function getEstadoLabelAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->estado));
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    // Filtrar por estado
    public function scopeEstado($query, string $estado)
    {
        return $query->where('estado', $estado);
    }

    // Filtrar documentos obligatorios
    public function scopeObligatorios($query)
    {
        return $query->where('es_obligatorio', true);
    }

    // Buscar documentos por título o descripción
    public function scopeBuscar($query, string $term)
    {
        return $query->where('titulo', 'like', "%$term%")
            ->orWhere('descripcion', 'like', "%$term%");
    }
}
