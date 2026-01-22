<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idopontfoglalas;
use App\Models\Szabadsagok;

class WorkerController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('worker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show');
    }

    // 4. Műszerfal (Dashboard)
    public function dashboard()
    {
        $dolgozo = Auth::guard('worker')->user();

        $foglalasok = Idopontfoglalas::where('dolgozo_id', $dolgozo->id)
            ->with(['felhasznalo', 'szolgaltatas', 'statusz'])
            ->whereDate('datum', '>=', now())
            ->orderBy('datum')
            ->orderBy('ido_kezdes')
            ->get();

        return view('worker.dashboard', compact('dolgozo', 'foglalasok'));
    }

    public function updateStatus($id)
    {
        $foglalas = Idopontfoglalas::where('id', $id)
            ->where('dolgozo_id', Auth::guard('worker')->id())
            ->firstOrFail();

        $foglalas->statuszok_id = 2; 
        $foglalas->save();

        return back()->with('success', 'A foglalást elfogadtad.');
    }

    public function storeVacation(Request $request)
    {
        $request->validate([
            'datum_kezdes' => 'required|date',
            'datum_vege' => 'required|date|after_or_equal:datum_kezdes',
        ]);
        
        Szabadsagok::create([
            'dolgozo_id' => Auth::guard('worker')->id(),
            'datum_kezdes' => $request->datum_kezdes,
            'datum_vege' => $request->datum_vege,
        ]);

        return back()->with('success', 'Szabadság sikeresen rögzítve.');
    }
}