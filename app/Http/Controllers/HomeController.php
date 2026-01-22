<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dolgozo;

class HomeController extends Controller
{
    public function index()
    {
        $dolgozok = Dolgozo::inRandomOrder()->take(3)->get();

        return view('home', compact('dolgozok'));
    }

    public function staff()
    {
        $allDolgozo = Dolgozo::orderBy('nev')->get();

        return view('dolgozok.index', compact('allDolgozo'));
    }
}
