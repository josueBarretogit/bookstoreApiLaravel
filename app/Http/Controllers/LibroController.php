<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{

    public function storeLibro(Request $request)
    {
        $libroToStore = new Libro();
        $libroToStore->autor_id = $request->autor_id;
        $libroToStore->titulo = $request->titulo;
        $libroToStore->precio = $request->precio;
        $libroToStore->portada = $request->portada;
        $libroToStore->descripcion = $request->descripcion;
        $libroToStore->numPaginas = $request->numPaginas;
        $libroToStore->calificacion = $request->calificacion;
        $libroToStore->fechaPublicacion = $request->fechaPublicacion;
        $libroToStore->genero = $request->genero;
        $libroToStore->idioma = $request->idioma;
        $libroToStore->isbn = $request->isbn;

        $autorAssociated = Autor::find($request->autor_id);
        $libroToStore->autor()->associate($autorAssociated);

        $libroToStore->save();
        return response()->json(['created' => 'true', "libro" => $libroToStore]);
    }


    public function showLibros(Request $request)
    {
        $libros = Libro::all();
        $autor = Libro::find(1);
        return response()->json([
            "libros" => $libros,
            "autor" => $autor
        ]);
    }
}