<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Termek;
use App\Models\Lehetoseg;

class TermekController extends Controller
{
    public function index(Request $request)
    {
        // 1. Alap lekérdezés: minden termék + a kategóriája
        $query = Termek::with('lehetoseg');

        // 2. Ha írt be valamit a keresőbe (név vagy leírás alapján keresünk)
        if ($request->filled('kereses')) {
            $kereses = $request->kereses;
            // Itt a function($q) egy zárójelet hoz létre az SQL-ben!
            $query->where(function($q) use ($kereses) {
                $q->where('nev', 'like', '%' . $kereses . '%')
                  ->orWhere('leiras', 'like', '%' . $kereses . '%');
            });
        }

        // 3. Ha kiválasztott egy kategóriát a legördülőből
        if ($request->filled('kategoria')) {
            $query->where('lehetosegek_id', $request->kategoria);
        }

        // 4. Lekérjük a szigorúan szűrt termékeket
        $termekek = $query->get();

        // 5. Lekérjük az összes kategóriát a legördülő menühöz
        $kategoriak = Lehetoseg::all();
        
        return view('termekek.index', compact('termekek', 'kategoriak'));
    }
}