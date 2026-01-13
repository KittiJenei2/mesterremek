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
use Illuminate\Support\Facades\Mail;
use App\Mail\FoglalasLetrehozva;
use Illuminate\Support\Facades\DB;


class IdopontfoglalasController extends Controller
{
    public function index()
    {
        $lehetosegek = Lehetoseg::all();

        $szolgaltatasok = Szolgaltatas::with('kategoria')->get();

        $dolgozok = Dolgozo::all();

        return view('idopontfoglalas.index', compact('szolgaltatasok','dolgozok', 'lehetosegek'));
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

    public function szolgaltatasokKategoriaAlapjan(Request $request)
    {
        $request->validate([
            'lehetoseg_id' => 'required|integer'
        ]);

        $szolgaltatasok = Szolgaltatas::where('lehetosegek_id', $request->lehetoseg_id)->get();

        return response()->json($szolgaltatasok);
    }

    public function dolgozokSzolgaltatasAlapjan(Request $request)
    {
        $request->validate([
            'szolgaltatas_id' => 'required|integer'
        ]);

        $szolgaltatas = Szolgaltatas::findOrFail($request->szolgaltatas_id);

        // Lehetosegek_id alapján keresünk (kategória)
        $dolgozok = DB::table('szolgaltatok')
            ->join('dolgozo', 'szolgaltatok.dolgozo_id', '=', 'dolgozo.id')
            ->where('szolgaltatok.lehetosegek_id', $szolgaltatas->lehetosegek_id)
            ->select('dolgozo.id', 'dolgozo.nev')
            ->get();

        return response()->json($dolgozok);
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

    // Szolgáltatás lekérése
    $szolgaltatas = Szolgaltatas::findOrFail($request->szolgaltatas_id);

    // Dolgozó lekérése
    $dolgozo = Dolgozo::findOrFail($request->dolgozo_id);

    // Időpont vége
    $idoVeg = Carbon::parse($request->ido_kezdes)
                ->addMinutes($szolgaltatas->idotartam);

    // Foglalás mentése
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

    // --- EMAIL KÜLDÉS ---
    Mail::to(Auth::user()->email)->send(
        new FoglalasLetrehozva([
            'nev' => Auth::user()->nev,
            'szolgaltatas' => $szolgaltatas->nev,
            'dolgozo' => $dolgozo->nev,
            'datum' => $request->datum,
            'ido' => $request->ido_kezdes
        ])
    );

    return response()->json([
        'uzenet' => 'Foglalás sikeresen mentve!'
    ]);
}


public function foglalhatoNapok(Request $request)
{
    $request->validate([
        'dolgozo_id' => 'required|integer',
        'szolgaltatas_id' => 'required|integer',
    ]);

    $dolgozoId = $request->dolgozo_id;
    $szolgaltatasId = $request->szolgaltatas_id;

    $szolgaltatas = Szolgaltatas::findOrFail($szolgaltatasId);

    // Dolgozó munka napjai → nap ID-k
    $munkanapok = Beosztas::where('dolgozo_id', $dolgozoId)
        ->pluck('napok_id')
        ->toArray();

    // Szabadság intervallumok
    $szabadsagok = Szabadsagok::where('dolgozo_id', $dolgozoId)->get();

    $ma = now()->toDateString();
    $egyHonap = now()->addMonths(1); // max 1 hónapot engedünk előre

    $foglalhato = [];

    $datum = now()->copy();
    while ($datum <= $egyHonap) {

        // 1) múlt kizárása
        if ($datum->toDateString() < $ma) {
            $datum->addDay();
            continue;
        }

        // 2) dolgozó munkanapjai
        $napId = $datum->dayOfWeekIso; // 1 = hétfő ... 7 = vasárnap
        if (!in_array($napId, $munkanapok)) {
            $datum->addDay();
            continue;
        }

        // 3) szabadság kizárása
        $szabad = false;
        foreach ($szabadsagok as $szabadsag) {
            if ($datum->between($szabadsag->datum_kezdes, $szabadsag->datum_vege)) {
                $szabad = true;
                break;
            }
        }
        if ($szabad) {
            $datum->addDay();
            continue;
        }

        // Ha idáig eljutott → foglalható
        $foglalhato[] = $datum->toDateString();
        $datum->addDay();
    }

    return response()->json($foglalhato);
}



}
