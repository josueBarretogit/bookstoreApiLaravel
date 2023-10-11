<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function storeCuenta(Request $request)
    {
        $cuentaToStore = new Cuenta();
        $cuentaToStore->correo = $request->correo;
        $cuentaToStore->contrasena = $request->contrasena;

        $rolAssociated = Rol::find($request->rol_id);

        $cuentaToStore->rol()->associate($rolAssociated);

        $cuentaToStore->save();

        return response()->json(['created' => 'true', "cuenta" => $cuentaToStore, "rol" => $rolAssociated]);
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
