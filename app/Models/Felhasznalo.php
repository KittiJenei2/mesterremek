<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;

class Felhasznalo extends Authenticable
{
    use HasFactory;
    protected $table = 'felhasznalo';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nev',
        'email',
        'telefonszam',
        'jelszo',
        'keszitve'
    ];

    protected $hidden = [
        'jelszo'
    ];

    public function getAuthPassword()
    {
        return $this->jelszo;
    }

    // Megmondja a Laravelnek az oszlop pontos nevét
    public function getAuthPasswordName()
    {
        return 'jelszo';
    }
}
