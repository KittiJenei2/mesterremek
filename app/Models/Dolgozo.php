<?php

namespace App\Models;

use Illuminate\Cache\HasCacheLock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dolgozo extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'dolgozo';
    public $timestamps = false;

    protected $fillable = [
        'nev',
        'email',
        'telefon',
        'jelszo',
        'bio',
        'kep'
    ];

    protected $hidden = [
        'jelszo', 'remember_token',
    ];

     public function beosztasok()
    {
        return $this->hasMany(Beosztas::class, 'dolgozo_id');
    }

    public function szolgaltatasok()
    {
        return $this->belongsToMany(Lehetoseg::class, 'szolgaltatok', 'dolgozo_id', 'lehetosegek_id');
    }

    public function getAuthPassword()
    {
        return $this->jelszo;
    }
}
