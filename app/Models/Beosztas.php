<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beosztas extends Model
{
    protected $table = 'beosztasok';

    protected $fillable = [
        'dolgozo_id',
        'napok_id',
        'ido_kezdes',
        'ido_vege'
    ];

    public function dolgozo()
    {
        return $this->belongsTo(Dolgozo::class, 'dolgozo_id');
    }

    public function nap()
    {
        return $this->belongsTo(Napok::class, 'napok_id');
    }
}
