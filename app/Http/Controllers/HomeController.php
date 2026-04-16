<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dolgozo;
use Illuminate\Support\Facades\Mail;
use App\Mail\KapcsolatUzenet;

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
    public function sendContactEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'A név megadása kötelező.',
            'email.required' => 'Az email megadása kötelező.',
            'email.email' => 'Érvénytelen email formátum.',
            'subject.required' => 'A tárgy megadása kötelező.',
            'message.required' => 'Az üzenet megadása kötelező.',
            'message.min' => 'Az üzenetnek legalább 10 karakter hosszúnak kell lennie.'
        ]);

        $adatok = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        // E-mail küldése a szalon címére (ezt később átírhatod a valódira)
        Mail::to('info@freshszalon.hu')->send(new KapcsolatUzenet($adatok));

        return back()->with('success', 'Köszönjük az üzeneted! Hamarosan felvesszük veled a kapcsolatot.');
    }
}
