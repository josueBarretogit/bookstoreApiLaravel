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
        $permiso = Permiso::findOrFail($request->permso_id);
        $rolToStore->save($rolToStore);
        return response()->json(['created' => 'true', "rol" => $rolToStore]);
    }

    public function showroles(Request $request)
    {
        $roles = rol::all();
        return response()->json([
            "roles" => $roles,
        ]);
    }
}
