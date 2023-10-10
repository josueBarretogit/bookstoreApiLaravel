<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;

Route::get('/getAutores', [AutorController::class, 'showAutores']);

Route::post('/createAutor', [AutorController::class, 'storeAutor']);

Route::get('/updateAutor', [AutorController::class, 'showAutores']);

Route::post('/deleteAutor', [AutorController::class, 'storeAutor']);

Route::get('/getLibros', [LibroController::class, 'showLibros']);

Route::post('/createLibro', [LibroController::class, 'storeLibro']);

Route::get('/updateLibro', [LibroController::class, 'showLibros']);

Route::post('/deleteLibro', [LibroController::class, 'storeLibro']);

Route::get('/getPermisos', [PermisoController::class, 'showPermisos']);

Route::post('/createPermiso', [PermisoController::class, 'storePermiso']);

Route::get('/updateLibro', [PermisoCotroller::class, 'showLibros']);

Route::post('/deleteLibro', [PermisoCotroller::class, 'storeLibro']);

Route::get('/getRoles', [RolController::class, 'showRoles']);

Route::post('/createRol', [RolController::class, 'storeRol']);

