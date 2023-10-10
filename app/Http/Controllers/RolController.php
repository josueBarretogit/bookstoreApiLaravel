<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function storeRol(Request $request)
    {
        $rolToStore = new Rol();
        $rolToStore->nombreRol = $request->nombreRol;
        $permiso = Permiso::find($request->permiso_id);

        $permiso->rol()->save($rolToStore);

        return response()->json(['created' => 'true', "rol" => $rolToStore, "permiso" => $permiso]);
    }

    public function showRoles(Request $request)
    {
        $roles = Rol::all();
        return response()->json([
            "roles" => $roles,
        ]);
    }
}
