<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngajatAdresa extends Model
{
    use HasFactory;

    protected $table="angajati_adrese";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->belongsTo(Angajat::class, 'id');
    }

    public function judet(){
        return $this->belongsTo(Judet::class, 'aa_judet', 'id');
    }

    public function localitate(){
        return $this->belongsTo(Localitate::class, 'aa_localitate', 'id');
    }
}
