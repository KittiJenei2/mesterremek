<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Szolgaltatas;
use App\Models\Lehetoseg;

class SzolgaltatasController extends Controller
{
    public function index(Request $request)
    {
        // 1. Kezdő lekérdezés: minden szolgáltatás a kategóriával együtt
        $query = Szolgaltatas::with('kategoria');

        // 2. Ha a felhasználó írt be valamit a "Keresés" mezőbe
        if ($request->filled('kereses')) {
            $kereses = $request->kereses;
            
            // ITT A JAVÍTÁS: Zárójelbe tesszük a név VAGY leírás keresést!
            $query->where(function($q) use ($kereses) {
                $q->where('nev', 'like', '%' . $kereses . '%')
                  ->orWhere('leiras', 'like', '%' . $kereses . '%');
            });
        }

        // 3. Ha a felhasználó választott egy konkrét Kategóriát
        if ($request->filled('kategoria')) {
            $query->where('lehetosegek_id', $request->kategoria);
        }

        // 4. Lekérjük a szigorúan szűrt adatokat
        $szolgaltatasok = $query->get();

        // 5. Lekérjük az összes kategóriát (lehetőséget) a legördülő menühöz
        $kategoriak = Lehetoseg::all();

        return view('szolgaltatasok.index', compact('szolgaltatasok', 'kategoriak'));
    }
}