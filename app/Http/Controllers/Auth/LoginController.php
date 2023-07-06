<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        if ($user->role_id === 1) {
            return redirect()->route('student');
        } elseif ($user->role_id === 2) {
            return redirect()->route('admin');
        }
    }

    return redirect()->back()->withErrors(['message' => 'Credenciales inválidas'])->withInput();
    }

}
