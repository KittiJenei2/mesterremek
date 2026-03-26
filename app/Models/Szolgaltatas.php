<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Szolgaltatas extends Model
{
    use HasFactory;
    protected $table = 'szolgaltatasok';
    public $timestamps = false;

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
