<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::get('/getAutores', [AutorController::class, 'showAutores']);

Route::post('/createAutor', [AutorController::class, 'storeAutor']);

Route::get('/updateAutor', [AutorController::class, 'showAutores']);

Route::post('/deleteAutor', [AutorController::class, 'storeAutor']);



Route::get('/getLibros', [LibroController::class, 'showLibros']);

Route::post('/createLibro', [LibroController::class, 'storeLibro']);

Route::get('/updateLibro', [LibroController::class, 'showLibros']);

Route::post('/deleteLibro', [LibroController::class, 'storeLibro']);
