<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Felhasznalo;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');   
    }

    public function register(Request $request)
    {
         Felhasznalo::create([
            'nev' => $request->nev,
            'email' => $request->email,
            'telefonszam' => $request->telefonszam,
            'jelszo' => Hash::make($request->jelszo),
            'keszitve' => now(),
        ]);

        return redirect('/login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'jelszo' => 'required'
    ]);

    $user = Felhasznalo::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->jelszo, $user->jelszo)) {
        return back()->withErrors(['email' => 'Hibás email vagy jelszó']);
    }

    Auth::login($user);

    $request->session()->regenerate();

    return redirect()->route('idopontfoglalas.index');

}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('succes', 'Sikeres kijelentkezés!');
}

}
