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
        // --- ÚJ: Telefonszám megtisztítása mentés és validáció előtt ---
        if ($request->has('telefonszam') && $request->telefonszam != null) {
            // Minden felesleges szóköz, pluszjel, kötőjel eltávolítása
            $t = str_replace([' ', '+', '-', '/', '(', ')'], '', $request->telefonszam); 
            
            // Ha 36-tal kezdődik, cseréljük le 06-ra
            if (substr($t, 0, 2) === '36') {
                $t = '06' . substr($t, 2);
            }
            
            // Visszaírjuk a kérésbe a megtisztított adatot (így a validáció már ezt látja)
            $request->merge(['telefonszam' => $t]);
        }
        // --- TISZTÍTÁS VÉGE ---

        $request->validate([
            'nev' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:felhasznalo,email',
            'telefonszam' => [
                'required',
                'numeric',
                'digits:11',
                'regex:/^06\d{9}$/',
                'unique:felhasznalo,telefonszam'
            ],
            'jelszo' => [
                'required',
                'string',
                'min:8',
                'same:password_confirmation',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', 
            ],
        ], [
            'nev.required' => 'A név megadása kötelező.',
            'nev.string' => 'A névnek szövegnek kell lennie.',
            'nev.max' => 'A név túl hosszú.',

            'email.required' => 'Az email cím megadása kötelező.',
            'email.email' => 'Kérjük, érvényes email címet adjon meg.',
            'email.unique' => 'Ez az email cím már foglalt.',

            'telefonszam.required' => 'A telefonszám megadása kötelező.',
            'telefonszam.numeric' => 'A telefonszám csak számjegyeket tartalmazhat.',
            'telefonszam.digits' => 'A telefonszámnak pontosan 11 számjegyűnek kell lennie.',
            'telefonszam.regex' => 'A telefonszám formátuma hibás. Helyes formátum: 06301234567',
            'telefonszam.unique' => 'Ez a telefonszám már regisztrálva van.',

            'jelszo.required' => 'A jelszó megadása kötelező.',
            'jelszo.string' => 'A jelszónak szövegesnek kell lennie.',
            'jelszo.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'jelszo.same' => 'A megadott jelszavak nem egyeznek.',
            'jelszo.regex' => 'A jelszónak tartalmaznia kell kisbetűt, nagybetűt és számot!',
        ]);

        $user = Felhasznalo::create([
            'nev' => $request->nev,
            'email' => $request->email,
            'telefonszam' => $request->telefonszam, 
            'jelszo' => Hash::make($request->jelszo),
            'keszitve' => now(),
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('idopontfoglalas.index')->with('success', 'Sikeres regisztráció!');
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

        return redirect('/')->with('success', 'Sikeres kijelentkezés!');
    }
}