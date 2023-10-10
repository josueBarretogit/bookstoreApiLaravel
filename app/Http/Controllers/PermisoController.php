<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function storePermiso(Request $request)
    {
        $permisoToStore = new Permiso();
        $permisoToStore->nombrePermiso = $request->nombrePermiso;
        $permisoToStore->save();
        return response()->json(['created' => 'true', "permiso" => $permisoToStore]);
    }

    public function showPermisos(Request $request)
    {
        $permisos = Permiso::with('rol')->get();

        return response()->json([
            "permisos" => $permisos,
        ]);
    }
}
