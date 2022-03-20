<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categorias', [CategoriaController::class,'mostrarCategorias']);
Route::get('mostrarListaMarcas',[MarcasController::class, 'mostrarMarcas']);
Route::post('registrarMarca', [MarcasController::class,'registrarMarcas']);
Route::put('modificarMarca',[MarcasController::class, 'editarMarcas']);
