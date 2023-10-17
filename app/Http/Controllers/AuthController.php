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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $cuenta = Cuenta::find($request->correo);
            return response()->json([
                'token' => $cuenta->createToken('token')->plainTextToken(),
                'authenthicated' => true,
            ]);
        }

        return back()->withErrors([
            'email' => 'No se encontró este correo',
        ])->onlyInput('email');
    }
    public function logOut(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'correo' => 'required|string|max:255',
            'contrasena' => 'required|string|email|max:255|unique:users',
            'rol_id' => 'required',
        ]);

        var_dump($validatedData);
        $cuenta = Cuenta::create([
            'correo' => $validatedData['email'],
            'contrasena' => Hash::make($validatedData['password']),
        ]);

        $rolAssociated = Rol::find($request->rol_id);

        $cuenta->rol()->associate($rolAssociated);

        $token = $cuenta->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
