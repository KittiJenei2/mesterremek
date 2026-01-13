<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idopontfoglalas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        $felhasznalo = Auth::user();

        $foglalasok = Idopontfoglalas::where('felhasznalo_id', $felhasznalo->id)
            ->with('dolgozo', 'szolgaltatas')
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
            // 404-es hibakódot küldünk, ha nincs meg
            return response()->json(['uzenet' => 'Foglalás nem található!'], 404);
        }

        if (strtotime($foglalas->datum) < strtotime('today')) {
            // 400-as hibakódot küldünk, ha múltbeli
            return response()->json(['uzenet' => 'Múltbeli foglalást nem lehet lemondani!'], 400);
        }

        // --- ITT A VÁLTOZÁS: Töröljük a rekordot, nem csak a státuszt írjuk át ---
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
        'email' => 'required|email',
        'telefonszam' => 'nullable|string|max:20',
    ]);

    $user->nev = $request->nev;
    $user->email = $request->email;
    $user->telefonszam = $request->telefonszam;
    $user->save();

    return redirect()->route('profile.index')->with('success', 'Adatok módosítva!');
}

public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed', // confirmed = keresi a password_confirmation mezőt
        ]);

        /** @var \App\Models\Felhasznalo $user */
        $user = Auth::user();

        // 1. Ellenőrizzük, hogy a beírt "Jelenlegi jelszó" egyezik-e az adatbázisban lévővel
        // Mivel nálad 'jelszo' a mező neve az adatbázisban, így hivatkozunk rá: $user->jelszo
        if (!Hash::check($request->current_password, $user->jelszo)) {
            throw ValidationException::withMessages([
                'current_password' => ['A megadott jelenlegi jelszó helytelen.'],
            ]);
        }

        // 2. Ha jó volt a régi, mentsük el az újat (titkosítva!)
        $user->jelszo = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'A jelszó sikeresen módosítva!');
    }


}
