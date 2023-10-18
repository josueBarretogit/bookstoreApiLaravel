<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Cliente;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{

    public function storeLibro(Request $request)
    {
        try {
            $libroToStore = new Libro;

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
            $clienteAssociatedToLibro = Cliente::find($request->cliente_id);

            $libroToStore->autor()->associate($autorAssociated);
            $libroToStore->clientes()->attach($clienteAssociatedToLibro);

            $libroToStore->save();

            return response()->json(['created' => 'true', "libro" => $libroToStore], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }


    public function showLibros(Request $request)
    {
        try {
            $libros = Libro::with('autor')->get();

            return response()->json([
                "libros" => $libros,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
