<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idopontfoglalas;

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
    $foglalas = Idopontfoglalas::findOrFail($id);

    if ($foglalas->felhasznalo_id !== Auth::id()) {
        return back()->with('error', 'Nincs jogosultságod törölni ezt a foglalást.');
    }

    $foglalas->delete();

    return back()->with('success', 'Foglalás sikeresen törölve.');
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
}
