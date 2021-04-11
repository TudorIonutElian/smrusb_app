<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functii extends Model
{
    use HasFactory;

    protected $table="functii";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function pozitii(){
        return $this->hasOne(PozitiiOrganizare::class, 'id');
    }

    public function angajati(){
        return $this->belongsTo(Angajat::class, 'angajat_functie_curenta');
    }

    public function mutatii(){
        return $this->hasMany(MutatiiProfesionale::class, 'mp_functie_id', 'id');
    }

    public function salarii(){
        return $this->hasMany(Salariu::class, 's_functie', 'id');
    }
}
