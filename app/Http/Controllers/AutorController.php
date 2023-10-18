<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function storeAutor(Request $request)
    {
        try {
            $autorToStore = new Autor();
            $autorToStore->nombre = $request->nombre;
            $autorToStore->apellido = $request->apellido;
            $autorToStore->aboutDescripcion = $request->aboutDescripcion;
            $autorToStore->save();
            return response()->json(['created' => 'true', "autor" => $autorToStore], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function showAutores(Request $request)
    {
        try {
            $autores = Autor::all();
            $oneAutor = Autor::find(1);
            return response()->json([
                "autores" => $autores,
                "unAutor" => $oneAutor
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
