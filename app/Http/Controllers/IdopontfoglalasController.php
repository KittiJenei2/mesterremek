<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Szolgaltatas;
use App\Models\Dolgozo;
use App\Models\Lehetoseg;
use App\Models\Idopontfoglalas;
use App\Models\Napok;
use App\Models\Beosztas;
use App\Models\Szabadsagok;

class IdopontfoglalasController extends Controller
{
    public function index()
    {
        $szolgaltatasok = Szolgaltatas::with('kategoria')->get();

        $dolgozok = Dolgozo::all();

        return view('idopontfoglalas.index', compact('szolgaltatasok','dolgozok'));
    }
    private function convertDay($english)
    {
        $english = strtolower($english);
        $napok = [
            'monday'    => 'Hétfő',
            'tuesday'   => 'Kedd',
            'wednesday' => 'Szerda',
            'thursday'  => 'Csütörtök',
            'friday'    => 'Péntek',
            'saturday'  => 'Szombat',
            'sunday'    => 'Vasárnap',
        ];
    
        return $napok[$english] ?? null;
    }


    public function SzabadIdopontok(Request $request)
    {
        $request->validate([
            'szolgaltatas_id' => 'required|integer',
            'dolgozo_id' => 'required|integer',
            'datum' => 'required|date'
        ]);

        $szolgaltatasId = $request->szolgaltatas_id;
        $dolgozoId = $request->dolgozo_id;
        $datum = $request->datum;

        //Időtartam számítása
        $szolgaltatas = Szolgaltatas::findOrFail($szolgaltatasId);
        $idotartam = $szolgaltatas->idotartam;

        //Dolgozó beosztása
        $napNev = strtolower(Carbon::parse($datum)->format('l'));

        //napok tábla
        $nap = Napok::where('nev', $this->convertDay($napNev))->first();
        if (!$nap){
            return response()->json(['idopontok' => []]);
        }

        $beosztas = Beosztas::where('dolgozo_id', $dolgozoId)->where('napok_id', $nap->id)->first();
        if (!$beosztas){
            return response()->json(['idopontok' => []]);
        }

        $kezdes = $beosztas->ido_kezdes;
        $vege = $beosztas->ido_vege;

        //szabadságok
        $szabadsagon = Szabadsagok::where('dolgozo_id', $dolgozoId)
        ->whereDate('datum_kezdes', '<=', $datum)
        ->whereDate('datum_vege', '>=', $datum)
        ->exists();

        if ($szabadsagon) {
            return response()->json(['idopontok' => []]);
        }

        // 4️⃣ Már lefoglalt időpontok
    $foglalasok = Idopontfoglalas::where('dolgozo_id', $dolgozoId)
        ->whereDate('datum', $datum)
        ->get(['ido_kezdes', 'ido_vege']);

    // 5️⃣ Időpontok generálása
    $freeTimes = [];

    $current = Carbon::parse($kezdes);
    $end = Carbon::parse($vege);

    while ($current->copy()->addMinutes($idotartam)->lte($end)) {

        $slotStart = $current->format('H:i');
        $slotEnd = $current->copy()->addMinutes($idotartam)->format('H:i');

        // ütközés ellenőrzése
        $utkozik = false;

        foreach ($foglalasok as $f) {
            if (
                ($slotStart >= $f->ido_kezdes && $slotStart < $f->ido_vege) ||
                ($slotEnd > $f->ido_kezdes && $slotEnd <= $f->ido_vege)
            ) {
                $utkozik = true;
                break;
            }
        }

        if (!$utkozik) {
            $freeTimes[] = $slotStart;
        }

        $current->addMinutes(15); // 15 perces lépésköz
    }

    return response()->json(['idopontok' => $freeTimes]);

    }

    public function store(Request $request)
{
    $request->validate([
        'szolgaltatas_id' => 'required|integer',
        'dolgozo_id' => 'required|integer',
        'datum' => 'required|date',
        'ido_kezdes' => 'required'
    ]);

    $szolgaltatas = Szolgaltatas::findOrFail($request->szolgaltatas_id);
    $idoVeg = Carbon::parse($request->ido_kezdes)->addMinutes($szolgaltatas->idotartam);

    $foglalas = Idopontfoglalas::create([
        'felhasznalo_id' => Auth::id(), 
        'dolgozo_id' => $request->dolgozo_id,
        'szolgaltatasok_id' => $request->szolgaltatas_id,
        'datum' => $request->datum,
        'ido_kezdes' => $request->ido_kezdes,
        'ido_vege' => $idoVeg->format('H:i'),
        'statuszok_id' => 1,
        'foglalas_idopontja' => now()
    ]);

    return response()->json(['uzenet' => 'Foglalás sikeresen mentve!']);
}


}
