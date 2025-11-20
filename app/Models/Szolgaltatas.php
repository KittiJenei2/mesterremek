<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Szolgaltatas extends Model
{
    protected $table = 'szolgaltatasok';

    protected $fillable = [
        'nev',
        'ar',
        'idotartam',
        'lehetosegek_id',
        'leiras',
    ];
    public function kategoria()
    {
        return $this->belongsTo(Lehetoseg::class, 'lehetosegek_id');
    }
}
