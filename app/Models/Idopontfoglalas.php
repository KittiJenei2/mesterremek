<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idopontfoglalas extends Model
{
    protected $table = 'idopontfoglalas';
    public $timestamps = false;

    protected $fillable = [
        'felhasznalo_id',
        'dolgozo_id',
        'szolgaltatasok_id',
        'datum',
        'ido_kezdes',
        'ido_vege',
        'statuszok_id',
        'foglalas_idopontja',
    ];

    public function dolgozo()
    {
        return $this->belongsTo(Dolgozo::class, 'dolgozo_id');
    }

    public function felhasznalo()
    {
        return $this->belongsTo(Felhasznalo::class, 'felhasznalo_id');
    }

    public function szolgaltatas()
    {
        return $this->belongsTo(Szolgaltatas::class, 'szolgaltatasok_id');
    }

    public function statusz()
    {
        return $this->belongsTo(\App\Models\Statusz::class, 'statuszok_id');
    }
}
