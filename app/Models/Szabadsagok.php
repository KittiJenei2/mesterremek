<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Szabadsagok extends Model
{
    protected $table = 'szabadsagok';
    public $timestamps = false;

    protected $fillable = [
        'dolgozo_id',
        'datum_kezdes',
        'datum_vege'
    ];

    public function dolgozo()
    {
        return $this->belongsTo(Dolgozo::class, 'dolgozo_id');
    }
}
