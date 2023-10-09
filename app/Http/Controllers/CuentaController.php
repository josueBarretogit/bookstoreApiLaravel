<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function storeCuenta(Request $request)
    {
        $cuentaToStore = new Cuenta();
        $cuentaToStore->nombre = $request->nombre;
        $cuentaToStore->apellido = $request->apellido;
        $cuentaToStore->aboutDescripcion = $request->aboutDescripcion;
        $cuentaToStore->save();
        return response()->json(['created' => 'true', "cuenta" => $cuentaToStore]);
    }

    public function showCuentas(Request $request)
    {
        $cuentaes = Cuenta::all();
        $onecuenta = Cuenta::find(1);
        return response()->json([
            "cuentaes" => $cuentaes,
            "uncuenta" => $onecuenta
        ]);
    }
}
