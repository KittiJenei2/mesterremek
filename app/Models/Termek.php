<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termek extends Model
{
    // A tábla neve az adatbázisban
    protected $table = 'termekek';

    // FONTOS: Mivel a tábládban nincsenek created_at és updated_at oszlopok
    public $timestamps = false;

    // Engedélyezett mezők a tömeges kitöltéshez
    protected $fillable = [
        'nev', 
        'leiras', 
        'ar', 
        'lehetosegek_id'
    ];

    // Kapcsolat a kategóriával (lehetőségek táblával)
    public function lehetoseg()
    {
        return $this->belongsTo(Lehetoseg::class, 'lehetosegek_id');
    }
}