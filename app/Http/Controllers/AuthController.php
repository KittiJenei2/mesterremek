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

        if ($user && Hash::check($request->jelszo, $user->jelszo)) {
            Auth::guard('web')->login($user); 
            $request->session()->regenerate();
            
            return redirect()->route('idopontfoglalas.index');
        }

        if (Auth::guard('worker')->attempt(['email' => $request->email, 'password' => $request->jelszo])) {
            $request->session()->regenerate();
            
            return redirect()->route('worker.dashboard');
        }

        return back()->withErrors(['email' => 'Hibás email cím vagy jelszó!']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('worker')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('succes', 'Sikeres kijelentkezés!');
    }
}
