<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Napok extends Model
{
    protected $table = 'napok';

    protected $fillable = [
        'nev',
    ];

    public $timestamps = false;

    public function beosztasok()
    {
        return $this->hasMany(Beosztas::class, 'napok_id');
    }
}
