<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function storeCuenta(Request $request)
    {
        $cuentaToStore = new Cuenta(
            [
                'correo' => $request->correo,
                'contrasena' => $request->contrasena,
            ]
        );

        $rolAssociated = Rol::find($request->rol_id);

        $cuentaToStore->rol()->associate($rolAssociated);

        $cuentaToStore->save();

        return response()->json(['created' => 'true', "cuenta" => $cuentaToStore, "rol" => $rolAssociated]);
    }

    public function showCuentas(Request $request)
    {
        $cuentas = Cuenta::with('rol')->get();
        return response()->json([
            "cuentaes" => $cuentas,
        ]);
    }
}
