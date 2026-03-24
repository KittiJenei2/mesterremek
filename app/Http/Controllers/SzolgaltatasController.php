<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Szolgaltatas;
use App\Models\Lehetoseg; // Ezt be kell importálni a kategóriákhoz!

class SzolgaltatasController extends Controller
{
    public function index(Request $request)
    {
        // 1. Kezdő lekérdezés: minden szolgáltatás a kategóriával együtt
        $query = Szolgaltatas::with('kategoria');

        // 2. Ha a felhasználó írt be valamit a "Keresés" mezőbe
        if ($request->filled('kereses')) {
            $query->where('nev', 'like', '%' . $request->kereses . '%')
                  ->orWhere('leiras', 'like', '%' . $request->kereses . '%'); // Ha van leírás oszlopod
        }

        // 3. Ha a felhasználó választott egy konkrét Kategóriát
        if ($request->filled('kategoria')) {
            $query->where('lehetosegek_id', $request->kategoria);
        }

        // 4. Lekérjük a szűrt adatokat
        $szolgaltatasok = $query->get();

        // 5. Lekérjük az összes kategóriát (lehetőséget) a legördülő menühöz
        $kategoriak = Lehetoseg::all();

        return view('szolgaltatasok.index', compact('szolgaltatasok', 'kategoriak'));
    }
}