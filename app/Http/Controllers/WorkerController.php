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

        // 1. Közelgő foglalások a táblázathoz (csak a jövőbeliek)
        $foglalasok = Idopontfoglalas::where('dolgozo_id', $dolgozo->id)
            ->with(['felhasznalo', 'szolgaltatas', 'statusz'])
            ->whereDate('datum', '>=', now())
            ->orderBy('datum')
            ->orderBy('ido_kezdes')
            ->get();

        // 2. Az ÖSSZES foglalás a naptárhoz (hogy a múlt is látszódjon)
        $osszesFoglalas = Idopontfoglalas::where('dolgozo_id', $dolgozo->id)
            ->with(['felhasznalo', 'szolgaltatas'])
            ->get();

        // 3. A dolgozó szabadságai
        $szabadsagok = Szabadsagok::where('dolgozo_id', $dolgozo->id)->get();

        // --- NAPTÁR ESEMÉNYEK GENERÁLÁSA ---
        $calendarEvents = [];

        foreach ($osszesFoglalas as $f) {
            $color = '#6c757d'; // Alap (szürke)
            if ($f->statuszok_id == 1) $color = '#ffc107'; // Függőben (sárga)
            elseif ($f->statuszok_id == 2) $color = '#198754'; // Elfogadva (zöld)
            elseif ($f->statuszok_id == 4) $color = '#0d6efd'; // Elvégezve (kék)

            $calendarEvents[] = [
                'title' => $f->felhasznalo->nev . ' (' . $f->szolgaltatas->nev . ')',
                'start' => $f->datum . 'T' . $f->ido_kezdes,
                'end' => $f->datum . 'T' . $f->ido_vege,
                'color' => $color,
            ];
        }

        foreach ($szabadsagok as $sz) {
            $calendarEvents[] = [
                'title' => '🏖 Szabadság',
                'start' => $sz->datum_kezdes,
                // A FullCalendar-nál az egész napos esemény 'end' dátuma exkluzív, ezért hozzá kell adni 1 napot
                'end' => \Carbon\Carbon::parse($sz->datum_vege)->addDay()->format('Y-m-d'),
                'color' => '#dc3545', // Piros
                'display' => 'block' // Kiemelt blokk
            ];
        }

        return view('worker.dashboard', compact('dolgozo', 'foglalasok', 'calendarEvents'));
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