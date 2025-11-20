<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dolgozo extends Model
{
    protected $table = 'dolgozo';

    protected $fillable = [
        'nev',
        'email',
        'telefon',
        'jelszo',
        'bio',
        'kep'
    ];

     public function beosztasok()
    {
        return $this->hasMany(Beosztas::class, 'dolgozo_id');
    }

    public function szolgaltatasok()
    {
        return $this->belongsToMany(Lehetoseg::class, 'szolgaltatok', 'dolgozo_id', 'lehetosegek_id');
    }
}
