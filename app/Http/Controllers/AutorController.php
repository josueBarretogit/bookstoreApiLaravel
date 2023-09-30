<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function storeAutor(Request $request)
    {
        $autorToStore = new Autor();
        $autorToStore->nombre = $request->nombre;
        $autorToStore->apellido = $request->apellido;
        $autorToStore->aboutDescripcion = $request->aboutDescripcion;
        $autorToStore->save();
        return response()->json(['created' => 'true', "autor" => $autorToStore]);
    }
}
