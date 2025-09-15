<?php

use App\Http\Controllers\Api\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categorias', CategoriaController::class);

// Route::get("categorias", [CategoriaController::class, 'index']);
// Route::post("categorias", [CategoriaController::class, 'store']);
// Route::get("categorias/{id}", [CategoriaController::class, 'show']);
// Route::put("categorias/{id}", [CategoriaController::class, 'update']);
// Route::delete("categorias/{id}", [CategoriaController::class, 'destroy']);
