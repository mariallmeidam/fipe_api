<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\AnoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/marca', [MarcaController::class, 'create']);
Route::get('/modelo', [ModeloController::class, 'create']);
Route::get('/ano', [AnoController::class, 'create']);

