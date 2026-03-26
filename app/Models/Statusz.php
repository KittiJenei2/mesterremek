<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Statusz extends Model
{
    use HasFactory;
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
