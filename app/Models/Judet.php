<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Localitate;

class Judet extends Model
{
    use HasFactory;
    protected $table="judete";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function regiune(){
        return $this->belongsTo(Regiune::class, 'regiune');
    }

    public function get_numar_localitati(){
        return $this->hasMany('App\Models\Localitate', 'judet');
    }

    public function adrese(){
        return $this->hasMany('App\Models\AngajatAdresa', 'aa_judet');
    }
}
