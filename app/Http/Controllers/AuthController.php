<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
       $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email', 
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->first_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'is_premium' => false,
    ]);


        Auth::login($user);
        return redirect('/dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

   
}
