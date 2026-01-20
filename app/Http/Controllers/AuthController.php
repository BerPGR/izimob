<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'user' => to_route('home'),
                'admin' => to_route('dashboard'),
                default => to_route('home'),
            };
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefone' => 'required|string|unique:users,telefone',
            'document' => 'required|string|unique:users,document',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telefone' => $data['telefone'],
            'document' => $data['document'],
            'role' => $data['role'],
            'password' => $data['password'],
        ]);

        Auth::login($user);

        return match ($user->role) {
            'user' => to_route('home'),
            'admin' => to_route('dashboard'),
            default => to_route('home'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('auth');
    }
}
