<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;

//autores
Route::get('/getAutores', [AutorController::class, 'showAutores']);

Route::post('/createAutor', [AutorController::class, 'storeAutor']);

Route::patch('/updateAutor', [AutorController::class, 'showAutores']);

Route::delete('/deleteAutor', [AutorController::class, 'storeAutor']);
//

//libros
Route::get('/getLibros', [LibroController::class, 'showLibros']);

Route::post('/createLibro', [LibroController::class, 'storeLibro']);

Route::patch('/updateLibro', [LibroController::class, 'showLibros']);

Route::delete('/deleteLibro', [LibroController::class, 'storeLibro']);
//

//permisos
Route::get('/getPermisos', [PermisoController::class, 'showPermisos']);

Route::post('/createPermiso', [PermisoController::class, 'storePermiso']);

Route::patch('/updateLibro', [PermisoController::class, 'editPermiso']);

Route::delete('/deleteLibro', [PermisoCotroller::class, 'storeLibro']);
//

//roles
Route::get('/getRoles', [RolController::class, 'showRoles']);

Route::post('/createRol', [RolController::class, 'storeRol']);

Route::patch('/updateRol', [RolController::class, 'editRol']);
