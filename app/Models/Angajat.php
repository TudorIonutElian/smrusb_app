<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angajat extends Model
{
    use HasFactory;

    protected $table="angajati";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function adresa(){
        return $this->hasMany(AngajatAdresa::class, 'aa_angajat');
    }

    public function profile(){
        return $this->hasMany(AngajatProfileSociale::class, 'aps_angajat');
    }

    // returnare pozitie
    public function pozitie(){
        return $this->hasOne(PozitiiOrganizare::class, 'ps_angajat', 'id');
    }

    // returnare pozitie
    public function mutatii(){
        return $this->hasMany(MutatiiProfesionale::class, 'mp_angajat_id');
    }
}
