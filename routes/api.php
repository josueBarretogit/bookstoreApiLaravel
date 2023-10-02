<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/getLibro', function (Request $request) {

    return response()->json([
        "hola" => 'gola'
    ]);
});

Route::get('/getAutores', [AutorController::class, 'showAutores']);

Route::get('/getLibros', [LibroController::class, 'showLibros']);

Route::post('/createAutor', [AutorController::class, 'storeAutor']);



Route::post('/createLibro', [LibroController::class, 'storeLibro']);
