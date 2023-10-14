<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpKernel\Exception\HttpException;


function verificarContrasena(string $contrasenaEncrypted, string $contrasenaFromRequest)
{

    $contrasenaDecrypted = Crypt::decryptString($contrasenaEncrypted);

    if ($contrasenaDecrypted != $contrasenaFromRequest) {
        throw new HttpException(401, 'No puedes editar esta cuenta');
    }
}


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
        verificarContrasena($cuentaToEdit->contrasena, $request->contrasena);

        $cuentaToEdit->contrasena =  Crypt::encryptString($request->contrasenaNueva);
        $cuentaToEdit->save();

        return response()->json([
            "cuentaEdited" => $cuentaToEdit,
        ]);
    }

    public function destroyCuenta(Request $request)
    {
        $cuentaToDelete = Cuenta::findOrFail($request->id);

        verificarContrasena($cuentaToDelete->contrasena, $request->contrasena);

        $cuentaToDelete->delete();
        return response()->json([
            "roles" => $cuentaToDelete,
        ]);
    }
}
