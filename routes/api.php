<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadMedidaController;
// 
use App\Http\Controllers\Auth\LoginController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/articulos', 'App\Http\Controllers\ArticuloControllers@index'); // mostrar todos los registros
// Route::post('/articulos', 'App\Http\Controllers\ArticuloControllers@store'); // crear un registro
// Route::put('/articulos/{id}', 'App\Http\Controllers\ArticuloControllers@update'); // actualizar un registro
// Route::delete('/articulos/{id}', 'App\Http\Controllers\ArticuloControllers@destroy'); // crear un registro




Route::group(['middleware' => ['web']], function () {
    // your routes here
    // LOGIN
    // Route::post('/login', [LoginController::class, 'login']);


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // ARTICULOS
    Route::get('/articulo/obtenerTodos', [ArticuloController::class,'index']);
    Route::get('/articulo/obtenerTodosSelect', [ArticuloController::class,'getTodosSelect']);
    Route::get('/articulo/obtenerDatos/{id}', [ArticuloController::class,'getDatos']);
    Route::post('/articulo/crear', [ArticuloController::class,'store']);
    Route::put('/articulo/actualizar/{id}', [ArticuloController::class,'update']);
    Route::delete('/articulo/eliminar/{id}', [ArticuloController::class,'destroy']);

    // CATEGORIAS
    Route::get('/categoria/obtenerTodos', [CategoriaController::class,'getTodos']);
    Route::get('/categoria/obtenerTodosSelect', [CategoriaController::class,'getTodosSelect']);
    Route::get('/categoria/obtenerDatos/{id}', [CategoriaController::class,'getDatos']);
    Route::post('/categoria/crear', [CategoriaController::class,'crear']);
    Route::put('/categoria/actualizar/{id}', [CategoriaController::class,'actualizar']);
    Route::delete('/categoria/eliminar/{id}', [CategoriaController::class,'eliminar']);

    // UNIDADES DE MEDIDA
    Route::get('/unidad-medida/obtenerTodos', [UnidadMedidaController::class,'getTodos']);
    Route::get('/unidad-medida/obtenerTodosSelect', [UnidadMedidaController::class,'getTodosSelect']);
    Route::get('/unidad-medida/obtenerDatos/{id}', [UnidadMedidaController::class,'getDatos']);
    Route::post('/unidad-medida/crear', [UnidadMedidaController::class,'crear']);
    Route::put('/unidad-medida/actualizar/{id}', [UnidadMedidaController::class,'actualizar']);
    Route::delete('/unidad-medida/eliminar/{id}', [UnidadMedidaController::class,'eliminar']);

});