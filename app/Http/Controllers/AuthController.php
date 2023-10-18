<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Rol;
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

            if (Auth::attempt($validatedData)) {

                $cuenta = Cuenta::find($request->correo);
                return response()->json([
                    'token' => $cuenta->createToken('token')->plainTextToken(),
                    'authenthicated' => true,
                ]);
            }

            return response()->json(['error' => 'Este usuario no esta registrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
    public function logOut(Request $request): RedirectResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
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
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 404);
        }
    }
}
