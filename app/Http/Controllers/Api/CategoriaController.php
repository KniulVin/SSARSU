<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexCategoriaRequest;
use App\Services\CategoriaService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriaController extends Controller
{
    protected $service;

    /**
     * Create a new controller instance.
     * @param CategoriaService $service
     */
    public function __construct(CategoriaService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexCategoriaRequest $request)
    {
        $categorias = $this->service->index($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Listado de categorías obtenido correctamente',
            'data' => $categorias->items(),
            'pagination' => [
                'total' => $categorias->total(),
                'to' => $categorias->lastItem(),
                'prev_page_url' => $categorias->previousPageUrl(),
                'per_page' => $categorias->perPage(),
                'path' => $categorias->path(),
                'next_page_url' => $categorias->nextPageUrl(),
                'links' => $categorias->linkCollection(),
                'last_page' => $categorias->lastPage(),
                'last_page_url' => $categorias->url($categorias->lastPage()),
                'from' => $categorias->firstItem(),
                'first_page_url' => $categorias->url(1),
                'current_page' => $categorias->currentPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = $this->service->crear($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Categoría creada exitosamente',
            'data' => $categoria,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!ctype_digit($id) || (int)$id < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Id inválido',
                'errors' => ['id' => ['El id debe ser un entero positivo']]
            ], 422);
        }

        try {
            $categoria = $this->service->obtener($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Categoría obtenida correctamente',
                'data' => $categoria,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Categoría no encontrada',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, $id)
    {
        if (!ctype_digit($id) || (int)$id < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Id inválido',
                'errors' => ['id' => ['El id debe ser un entero positivo']]
            ], 422);
        }
        try {

            $categoria = $this->service->actualizar($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Categoría actualizada correctamente',
                'data' => $categoria,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Categoría no encontrada',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->service->eliminar($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Categoría eliminada correctamente',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Categoría no encontrada',
            ], 404);
        }
    }
}
