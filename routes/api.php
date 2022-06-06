<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticuloController;

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

// Route::get('/articulos', 'App\Http\Controllers\ArticuloControllers@index'); // mostrar todos los registros
// Route::post('/articulos', 'App\Http\Controllers\ArticuloControllers@store'); // crear un registro
// Route::put('/articulos/{id}', 'App\Http\Controllers\ArticuloControllers@update'); // actualizar un registro
// Route::delete('/articulos/{id}', 'App\Http\Controllers\ArticuloControllers@destroy'); // crear un registro


Route::get('/articulos', [ArticuloController::class,'index']);
Route::post('/articulos', [ArticuloController::class,'store']);
Route::put('/articulos/{id}', [ArticuloController::class,'update']);
Route::delete('/articulos/{id}', [ArticuloController::class,'destroy']);