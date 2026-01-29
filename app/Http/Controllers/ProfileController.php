<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idopontfoglalas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $felhasznalo = Auth::user();
        $most = now(); 

        Idopontfoglalas::where('felhasznalo_id', $felhasznalo->id)
            ->where('statuszok_id', '!=', 4) 
            ->where(function ($query) use ($most) {
                $query->where('datum', '<', $most->format('Y-m-d'))
                      ->orWhere(function ($q) use ($most) {
                          $q->where('datum', $most->format('Y-m-d'))
                            ->where('ido_kezdes', '<', $most->format('H:i:s'));
                      });
            })
            ->update(['statuszok_id' => 4]); 

        $foglalasok = Idopontfoglalas::where('felhasznalo_id', $felhasznalo->id)
            ->with(['dolgozo', 'szolgaltatas']) 
            ->orderBy('datum', 'asc') 
            ->get();

        return view('profile.index', compact('felhasznalo', 'foglalasok'));
    }

    public function cancel($id)
    {
        $foglalas = Idopontfoglalas::where('id', $id)
            ->where('felhasznalo_id', Auth::id())
            ->first();

        if (!$foglalas) {
            return response()->json(['uzenet' => 'Foglalás nem található!'], 404);
        }

        if (strtotime($foglalas->datum) < strtotime('today')) {
            return response()->json(['uzenet' => 'Múltbeli foglalást nem lehet lemondani!'], 400);
        }

        $foglalas->delete(); 

        return response()->json(['uzenet' => 'A foglalás sikeresen törölve.']);
    }

    public function edit()
    {
        $felhasznalo = Auth::user();
        return view('profile.edit', compact('felhasznalo'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Felhasznalo $user */
        $user = Auth::user();

        $request->validate([
            'nev' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('felhasznalo')->ignore($user->id),
            ],
            'telefonszam' => [
                'required',
                'numeric',
                'digits:11',
                'regex:/^06\d{9}$/',
                Rule::unique('felhasznalo')->ignore($user->id),
            ],
        ], [
            'nev.required' => 'A név megadása kötelező.',
            'nev.string' => 'A névnek szövegnek kell lennie.',
            'nev.max' => 'A név nem lehet hosszabb 50 karakternél.',

            'email.required' => 'Az email cím megadása kötelező.',
            'email.email' => 'Kérjük, érvényes email címet adjon meg.',
            'email.unique' => 'Ez az email cím már foglalt.',

            'telefonszam.required' => 'A telefonszám megadása kötelező.',
            'telefonszam.numeric' => 'A telefonszám csak számjegyeket tartalmazhat.', // <--- EZ HIÁNYZOTT
            'telefonszam.digits' => 'A telefonszámnak pontosan 11 számjegyűnek kell lennie.',
            'telefonszam.regex' => 'A telefonszám formátuma hibás. Helyes formátum: 06301234567',
            'telefonszam.unique' => 'Ez a telefonszám már más felhasználóhoz tartozik.',
        ]);

        $user->nev = $request->nev;
        $user->email = $request->email;
        $user->telefonszam = $request->telefonszam;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Adatok sikeresen módosítva!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'min:8',              
                'confirmed',          
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/' 
            ],
        ], [
            'current_password.required' => 'A jelenlegi jelszó megadása kötelező.',
            'password.required' => 'Az új jelszó megadása kötelező.',
            'password.min' => 'Az új jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'password.confirmed' => 'Az új jelszavak nem egyeznek.',
            'password.regex' => 'Az új jelszónak tartalmaznia kell kisbetűt, nagybetűt és számot!',
        ]);

        /** @var \App\Models\Felhasznalo $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->jelszo)) {
            throw ValidationException::withMessages([
                'current_password' => ['A megadott jelenlegi jelszó helytelen.'],
            ]);
        }

        $user->jelszo = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'A jelszó sikeresen módosítva!');
    }
}