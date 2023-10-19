<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'correo' => 'required|string|max:255',
                'contrasena' => 'required|string|max:255',
            ]);



            $cuenta = Cuenta::where('correo', $validatedData['correo'])->first();

            if (!$cuenta || !Hash::check($validatedData['contrasena'], $cuenta->contrasena)) {
                return response([
                    "response" => "este usuario no esta registrado",
                    "datos" => $validatedData

                ], 401);
            }

            $token = $cuenta->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                "cuenta" => $cuenta
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
    public function logOut(Request $request)
    {
        try {
            $cuenta = Auth::user();
            return response([
                "response" => "loggin out",
                "cuenta" => $cuenta

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }

    public function register(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'correo' => 'required|string|max:255',
                'contrasena' => 'required|string|max:255',
                'rol_id' => 'required',
            ]);

            $cuenta = new Cuenta();
            $cuenta->correo = $validatedData['correo'];
            $cuenta->contrasena = Hash::make($validatedData['contrasena']);

            $rolAssociated = Rol::find($request->rol_id);

            $cuenta->rol()->associate($rolAssociated);

            $cuenta->save();

            $token = $cuenta->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                "cuenta" => $cuenta
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
