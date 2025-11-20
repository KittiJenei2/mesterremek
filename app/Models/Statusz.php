<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statusz extends Model
{
    protected $table = 'statuszok';
    public $timestamps = false;

    protected $fillable = [
        'nev',
    ];

    public function statusz()
    {
        return $this->belongsTo(Statusz::class, 'statuszok_id');
    }
}
