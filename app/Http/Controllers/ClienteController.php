<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function storecliente(Request $request)
    {
        try {
            $clienteToStore = new Cliente();
            $clienteToStore->nombre = $request->nombre;
            $clienteToStore->apellido = $request->apellido;
            $clienteToStore->aboutDescripcion = $request->aboutDescripcion;
            $clienteToStore->save();
            return response()->json(['created' => 'true', "cliente" => $clienteToStore], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function showclientees(Request $request)
    {
        try {
            $clientees = Cliente::all();
            $onecliente = Cliente::find(1);
            return response()->json([
                "clientees" => $clientees,
                "uncliente" => $onecliente
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
