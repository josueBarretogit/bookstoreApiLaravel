<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function storePermiso(Request $request)
    {
        try {
            $permisoToStore = new Permiso();
            $permisoToStore->nombrePermiso = $request->nombrePermiso;
            $permisoToStore->save();
            return response()->json(['created' => 'true', "permiso" => $permisoToStore], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function showPermisos(Request $request)
    {
        try {
            $permisos = Permiso::with('rol')->get();

            return response()->json([
                "permisos" => $permisos,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function editPermiso(Request $request)
    {
        try {
            $permisoToEdit = Permiso::findOrFail($request->id);
            $permisoToEdit->nombrePermiso = $request->nombrePermiso;

            $permisoToEdit->save();

            return response()->json([
                "rolEdited" => $permisoToEdit,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function deletePermiso(Request $request)
    {
        try {
            $permisoToDelete = Permiso::findOrFail($request->id);

            $permisoToDelete->delete();
            return response()->json([
                "roles" => $permisoToDelete,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
