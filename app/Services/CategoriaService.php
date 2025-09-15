<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService
{
    public function index(array $filters = [])
    {
        $query = Categoria::query();

        // * Búsqueda
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $searchFieldsRaw = $filters['search_in'] ?? 'nombre,descripcion';

            // Convertir string separado por comas a array
            $searchFields = array_filter(
                explode(',', $searchFieldsRaw),
                fn($field) => in_array($field, ['nombre', 'descripcion'])
            );

            $query->where(function ($q) use ($search, $searchFields) {
                foreach ($searchFields as $field) {
                    $q->orWhere($field, 'ILIKE', "%{$search}%");
                }
            });
        }

        // * Ordenamiento
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDir = $filters['sort_dir'] ?? 'asc';

        if (in_array($sortBy, ['id', 'nombre', 'descripcion', 'created_at', 'updated_at'])) {
            $query->orderBy($sortBy, $sortDir);
        }

        // * Paginación
        $perPage = $filters['per_page'] ?? 10;
        $page = $filters['page'] ?? 1;

        return $query->paginate(perPage: $perPage, columns: ['*'], page: $page);
    }

    public function crear(array $data)
    {
        return Categoria::create($data);
    }

    public function obtener($id)
    {
        return Categoria::findOrFail($id);
    }

    public function actualizar($id, array $data)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update($data);
        return $categoria;
    }

    public function eliminar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return true;
    }
}
