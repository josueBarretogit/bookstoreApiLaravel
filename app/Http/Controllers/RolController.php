<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function storeRol(Request $request)
    {
        try {
            $rolToStore = new Rol();
            $rolToStore->nombreRol = $request->nombreRol;
            $permiso = Permiso::find($request->permiso_id);

            $permiso->rol()->save($rolToStore);

            return response()->json(['created' => 'true', "rol" => $rolToStore, "permiso" => $permiso], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function showRoles(Request $request)
    {
        try {
            $roles = Rol::with('permiso')->get();

            return response()->json([
                "roles" => $roles,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function editRol(Request $request)
    {
        try {
            $rolToEdit = Rol::findOrFail($request->id);
            $rolToEdit->nombreRol = $request->nombreRol;

            $rolToEdit->save();

            return response()->json([
                "rolEdited" => $rolToEdit,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function destroyRol(Request $request)
    {
        try {
            $rolToDelete = Rol::findOrFail($request->id);
            $rolToDelete->delete();

            return response()->json([
                "roles" => $rolToDelete,
            ], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
