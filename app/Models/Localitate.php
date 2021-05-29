<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Judet;

class Localitate extends Model
{
    use HasFactory;

    protected $table="localitati";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function getJudet(){
        return $this->belongsTo('App\Models\Judet', 'judet');
    }

    public function adrese(){
        return $this->hasMany('App\Models\AngajatAdresa', 'aa_localitate');
    }
}
