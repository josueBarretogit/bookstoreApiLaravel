<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function storecliente(Request $request)
    {
        $clienteToStore = new Cliente();
        $clienteToStore->nombre = $request->nombre;
        $clienteToStore->apellido = $request->apellido;
        $clienteToStore->aboutDescripcion = $request->aboutDescripcion;
        $clienteToStore->save();
        return response()->json(['created' => 'true', "cliente" => $clienteToStore]);
    }

    public function showclientees(Request $request)
    {
        $clientees = Cliente::all();
        $onecliente = Cliente::find(1);
        return response()->json([
            "clientees" => $clientees,
            "uncliente" => $onecliente
        ]);
    }
}
