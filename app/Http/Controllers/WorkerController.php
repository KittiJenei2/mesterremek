<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idopontfoglalas;
use App\Models\Szabadsagok;

class WorkerController extends Controller
{
    // 1. Login oldal
    public function showLogin()
    {
        return view('worker.login');
    }

    // 2. Beléptetés
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], // Az űrlapon 'password' a mező neve
        ]);

        // A 'worker' guardot használjuk. A Laravel automatikusan a 'jelszo' mezővel
        // fogja összehasonlítani, mert a Modelben beállítottuk a getAuthPassword-öt.
        if (Auth::guard('worker')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('worker.dashboard');
        }

        return back()->withErrors([
            'email' => 'Hibás email cím vagy jelszó.',
        ]);
    }

    // 3. Kijelentkezés
    public function logout(Request $request)
    {
        Auth::guard('worker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('worker.login');
    }

    // 4. Műszerfal (Dashboard)
    public function dashboard()
    {
        $dolgozo = Auth::guard('worker')->user();

        // Foglalások lekérése a kapcsolt táblákkal (User, Szolgáltatás, Státusz)
        // A te Idopontfoglalas modelledben a relációk: felhasznalo, szolgaltatas, statusz
        $foglalasok = Idopontfoglalas::where('dolgozo_id', $dolgozo->id)
            ->with(['felhasznalo', 'szolgaltatas', 'statusz'])
            ->whereDate('datum', '>=', now()) // Csak a jövőbeliek
            ->orderBy('datum')
            ->orderBy('ido_kezdes')
            ->get();

        return view('worker.dashboard', compact('dolgozo', 'foglalasok'));
    }

    // 5. Státusz módosítása (Elfogadás)
    public function updateStatus($id)
    {
        $foglalas = Idopontfoglalas::where('id', $id)
            ->where('dolgozo_id', Auth::guard('worker')->id())
            ->firstOrFail();

        // A statuszok táblában a 2-es ID az "Elfogadva"
        $foglalas->statuszok_id = 2; 
        $foglalas->save();

        return back()->with('success', 'A foglalást elfogadtad.');
    }

    // 6. Szabadság mentése
    public function storeVacation(Request $request)
    {
        $request->validate([
            'datum_kezdes' => 'required|date',
            'datum_vege' => 'required|date|after_or_equal:datum_kezdes',
        ]);

        // A szabadsagok táblában csak: id, dolgozo_id, datum_kezdes, datum_vege van.
        // Nincs 'ok' mező.
        Szabadsagok::create([
            'dolgozo_id' => Auth::guard('worker')->id(),
            'datum_kezdes' => $request->datum_kezdes,
            'datum_vege' => $request->datum_vege,
        ]);

        return back()->with('success', 'Szabadság sikeresen rögzítve.');
    }
}