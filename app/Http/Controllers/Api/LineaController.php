<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreLineaRequest;
use App\Http\Requests\UpdateLineaRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndexLineaRequest;
use App\Services\LineaService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LineaController extends Controller
{
    protected $service;

    /**
     * Create a new controller instance.
     * @param LineaService $service
     */
    public function __construct(LineaService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexLineaRequest $request)
    {
        $lineas = $this->service->index($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Listado de lineas obtenido correctamente',
            'data' => $lineas->items(),
            'pagination' => [
                'total' => $lineas->total(),
                'to' => $lineas->lastItem(),
                'prev_page_url' => $lineas->previousPageUrl(),
                'per_page' => $lineas->perPage(),
                'path' => $lineas->path(),
                'next_page_url' => $lineas->nextPageUrl(),
                'links' => $lineas->linkCollection(),
                'last_page' => $lineas->lastPage(),
                'last_page_url' => $lineas->url($lineas->lastPage()),
                'from' => $lineas->firstItem(),
                'first_page_url' => $lineas->url(1),
                'current_page' => $lineas->currentPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLineaRequest $request)
    {
        $linea = $this->service->crear($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Linea creada exitosamente',
            'data' => $linea,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $linea = $this->service->obtener($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Linea obtenida correctamente',
                'data' => $linea,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Linea no encontrada',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLineaRequest $request, $id)
    {
        try {

            $linea = $this->service->actualizar($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Linea actualizada correctamente',
                'data' => $linea,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Linea no encontrada',
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
                'message' => 'Linea eliminada correctamente',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Linea no encontrada',
            ], 404);
        }
    }
}
