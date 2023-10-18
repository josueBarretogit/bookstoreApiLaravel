<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;


function verificarContrasena(string $contrasenaEncrypted, string $contrasenaFromRequest)
{



    if (Hash::check($contrasenaFromRequest,  $contrasenaEncrypted)) {
        throw new HttpException(401, 'No puedes editar esta cuenta');
    }
}


class CuentaController extends Controller

{
    public function storeCuenta(Request $request)
    {

        try {
            $cuentaToStore = new Cuenta();
            $cuentaToStore->correo = $request->correo;
            $cuentaToStore->contrasena = Hash::make($request->contrasena);

            $rolAssociated = Rol::find($request->rol_id);

            $cuentaToStore->rol()->associate($rolAssociated);

            $cuentaToStore->save();

            return response()->json(['created' => 'true', "cuenta" => $cuentaToStore, "rol" => $rolAssociated], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function showCuentas(Request $request)
    {
        try {
            $cuentas = Cuenta::with('rol')->get();
            return response()->json([
                "cuentas" => $cuentas,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function editCuenta(Request $request)
    {
        try {
            $cuentaToEdit = Cuenta::findOrFail($request->id);
            $cuentaToEdit->correo = $request->correo;
            verificarContrasena($cuentaToEdit->contrasena, $request->contrasena);

            $cuentaToEdit->contrasena =  Hash::make($request->contrasenaNueva);
            $cuentaToEdit->save();

            return response()->json([
                "cuentaEdited" => $cuentaToEdit,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function jestroyCuenta(Request $request)
    {
        try {
            $cuentaToDelete = Cuenta::findOrFail($request->id);

            verificarContrasena($cuentaToDelete->contrasena, $request->contrasena);

            $cuentaToDelete->delete();
            return response()->json([
                "roles" => $cuentaToDelete,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
