<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lehetoseg extends Model
{
    use HasFactory;
    protected $table = 'lehetosegek';
    public $timestamps = false;

    protected $fillable = [
        'nev',
        'leiras',
    ];
    public function szolgaltatasok()
    {
        return $this->hasMany(Szolgaltatas::class, 'lehetosegek_id');
    }
}
