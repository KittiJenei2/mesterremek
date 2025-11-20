<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class Felhasznalo extends Authenticable
{
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
}
