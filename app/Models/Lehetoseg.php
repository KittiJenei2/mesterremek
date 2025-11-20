<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lehetoseg extends Model
{
    protected $table = 'lehetosegek';

    protected $fillable = [
        'nev',
        'leiras',
    ];
    public function szolgaltatasok()
    {
        return $this->hasMany(Szolgaltatas::class, 'lehetosegek_id');
    }
}
