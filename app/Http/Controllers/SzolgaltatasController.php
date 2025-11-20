<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Szolgaltatas;

class SzolgaltatasController extends Controller
{
    public function index()
    {
        $szolgaltatasok = Szolgaltatas::with('kategoria')->get();
        return view('szolgaltatasok.index', compact('szolgaltatasok'));
    }
}
