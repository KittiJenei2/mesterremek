<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Velemeny extends Model
  {
    use HasFactory;

    protected $table = 'velemenyek';
    protected $fillable = [
        'felhasznalo_id',
        'idopont_id',
        'ertekeles',
        'velemeny'
    ];

    public function felhasznalo()
    {
        return $this->belongsTo(Felhasznalo::class);
    }

    public function idopont()
    {
        return $this->belongsTo(Idopontfoglalas::class, 'idopont_id');
    }
  }