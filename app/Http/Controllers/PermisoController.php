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

    public function editPermiso(Request $request)
    {
        $permisoToEdit = Permiso::findOrFail($request->id);
        $permisoToEdit->nombrePermiso = $request->nombrePermiso;

        $permisoToEdit->save();

        return response()->json([
            "permisoEdited" => $permisoToEdit,
        ]);
    }

    public function deleteRol(Request $request)
    {
        $roles = Permiso::with('permiso')->get();

        return response()->json([
            "roles" => $roles,
        ]);
    }
}
