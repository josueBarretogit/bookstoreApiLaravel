<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CuentaController extends Controller
{
    public function storeCuenta(Request $request)
    {
        $cuentaToStore = new Cuenta();

        $cuentaToStore->correo = $request->correo;
        $cuentaToStore->contrasena = Crypt::encryptString($request->contrasena);

        $rolAssociated = Rol::find($request->rol_id);

        $cuentaToStore->rol()->associate($rolAssociated);

        $cuentaToStore->save();

        return response()->json(['created' => 'true', "cuenta" => $cuentaToStore, "rol" => $rolAssociated]);
    }

    public function showCuentas(Request $request)
    {
        $cuentas = Cuenta::with('rol')->get();
        return response()->json([
            "cuentas" => $cuentas,
        ]);
    }

    public function editCuenta(Request $request)
    {
        $cuentaToEdit = Cuenta::findOrFail($request->id);
        $cuentaToEdit->correo = $request->correo;
        if ($cuentaToEdit->contrasena != $request->contrasena) {
            abort(401, 'No puedes editar esta cuenta ');
        }
        $cuentaToEdit->contrasena =  Crypt::encryptString($request->contrasena);
        $cuentaToEdit->save();

        return response()->json([
            "rolEdited" => $cuentaToEdit,
        ]);
    }

    public function deleteCuenta(Request $request)
    {
        $cuentaToDelete = Cuenta::findOrFail($request->id);

        $cuentaToDelete->delete();
        return response()->json([
            "roles" => $cuentaToDelete,
        ]);
    }
}
