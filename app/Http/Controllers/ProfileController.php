<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Idopontfoglalas;
use App\Models\Velemeny;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
public function index()
    {
        $felhasznalo = Auth::user();

        $aktualis_foglalasok = Idopontfoglalas::where('felhasznalo_id', $felhasznalo->id)
            ->where('datum', '>=', now()->format('Y-m-d'))
            ->with(['szolgaltatas', 'dolgozo', 'statusz']) // Eager loading a teljesítményért
            ->orderBy('datum')
            ->get();

        $korabbi_foglalasok = Idopontfoglalas::where('felhasznalo_id', $felhasznalo->id)
            ->where('datum', '<', now()->format('Y-m-d'))
            ->with(['szolgaltatas', 'dolgozo', 'statusz', 'velemeny']) 
            ->orderBy('datum', 'desc')
            ->get();

        return view('profile.index', compact('felhasznalo', 'aktualis_foglalasok', 'korabbi_foglalasok'));
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'idopont_id' => 'required|exists:idopontfoglalas,id',
            'ertekeles' => 'required|integer|min:1|max:5',
            'velemeny' => 'nullable|string|max:500',
        ]);

        $foglalas = Idopontfoglalas::where('id', $request->idopont_id)
            ->where('felhasznalo_id', Auth::id())
            ->firstOrFail();

        if(Velemeny::where('idopont_id', $foglalas->id)->exists()) {
            return back()->with('error', 'Ehhez az időponthoz már küldtél visszajelzést.');
        }

        Velemeny::create([
            'felhasznalo_id' => Auth::id(),
            'idopont_id' => $foglalas->id,
            'ertekeles' => $request->ertekeles,
            'velemeny' => $request->velemeny
        ]);

        return back()->with('success', 'Köszönjük a visszajelzésedet!');
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

    // Időpont módosítása (csak óra, ugyanazon a napon)
    public function updateTime(Request $request, $id)
    {
        $request->validate([
            'ido_kezdes' => 'required|date_format:H:i',
        ]);

        // Megkeressük a foglalást
        $foglalas = Idopontfoglalas::where('id', $id)
            ->where('felhasznalo_id', Auth::id())
            ->firstOrFail();

        // 1. ELLENŐRZÉS: 2 órás szabály
        // A foglalás teljes dátuma és ideje
        $eredetiKezdes = Carbon::parse($foglalas->datum . ' ' . $foglalas->ido_kezdes);
        
        // Ha a mostani időhöz hozzáadunk 2 órát, és az már későbbi, mint a foglalás kezdete, akkor letiltjuk.
        if (now()->addHours(2)->gt($eredetiKezdes)) {
            return back()->with('error', 'A foglalás módosítása csak a kezdés előtt legkésőbb 2 órával lehetséges!');
        }

        // 2. ÜTKÖZÉSVIZSGÁLAT
        // Kiszámoljuk az új befejezési időt
        $idotartam = $foglalas->szolgaltatas->idotartam;
        $ujKezdes = Carbon::parse($foglalas->datum . ' ' . $request->ido_kezdes);
        $ujVege = $ujKezdes->copy()->addMinutes($idotartam);
        
        $ujKezdesStr = $ujKezdes->format('H:i');
        $ujVegeStr = $ujVege->format('H:i');

        // Megnézzük, van-e MÁSIK foglalás, ami ütközne az új időponttal
        // (A saját magunkkal való ütközést kizárjuk: where('id', '!=', $id))
        $utkozes = Idopontfoglalas::where('dolgozo_id', $foglalas->dolgozo_id)
            ->where('datum', $foglalas->datum)
            ->where('id', '!=', $id) 
            ->where(function ($query) use ($ujKezdesStr, $ujVegeStr) {
                $query->where('ido_kezdes', '<', $ujVegeStr)
                      ->where('ido_vege', '>', $ujKezdesStr);
            })
            ->exists();

        if ($utkozes) {
            return back()->with('error', 'A kiválasztott időpont sajnos már foglalt.');
        }

        // 3. MENTÉS
        $foglalas->ido_kezdes = $ujKezdesStr;
        $foglalas->ido_vege = $ujVegeStr;
        $foglalas->save();

        return back()->with('success', 'Az időpontot sikeresen módosítottuk!');
    }
}