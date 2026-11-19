<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterCon extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function actionregister(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'customer',   // Selalu customer, bukan dari input!
        ]);

        auth()->login($user);
        return redirect('/')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Halaman login untuk customer yang sudah punya akun.
     */
    public function login()
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Admin diarahkan ke panel Filament, customer ke toko
            return auth()->user()->role === 'admin'
                ? redirect('/admin')
                : redirect('/')->with('success', 'Login berhasil, selamat berbelanja!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }
}
