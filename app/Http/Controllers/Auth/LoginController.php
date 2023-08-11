<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user's status is 1 (available)
            if ($user->status === 1) {
                if ($user->role_id === 1) {
                    return redirect()->route('student');
                } elseif ($user->role_id === 2) {
                    return redirect()->route('admin');
                }
            } else {
                // Log out the user if their status is not 1
                Auth::logout();
                return redirect()->back()->withErrors(['message' => 'Usuario deshabilitado, contacta con el administrador'])->withInput();
            }
        }

        return redirect()->back()->withErrors(['message' => 'Credenciales inválidas'])->withInput();
    }

    public function logout()
    {
        Auth::logout();

        // Redirect to the desired page after logout
        return redirect()->route('login1');
    }
}
