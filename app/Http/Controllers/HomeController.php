<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dolgozo;

class HomeController extends Controller
{
    public function index()
    {
        $dolgozok = Dolgozo::all();
        return view('home', compact('dolgozok'));
    }
}
