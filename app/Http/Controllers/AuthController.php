<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return response()->json('wellcome', 200);
        } else {
            return response()->json('Verifique sus credenciales de usuario.', 422);
        }
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}