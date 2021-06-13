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
        return $this->hasOne(AngajatAdresa::class, 'aa_angajat');
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

    //returnare judet de nastere
    public function judet_nastere(){
        return $this->hasOne(Judet::class, 'id', 'angajat_judet_nastere');
    }

    // returnare institutia curenta a angajatului
    public function institutie_curenta(){
        return $this->hasOne(Institutii::class, 'institutie_cod_acces', 'angajat_cod_acce');
    }

    // returnare functia curenta a angajatului
    public function get_functie_curenta(){
        return $this->hasOne(Functii::class, 'id', 'angajat_functie_curenta');
    }

    // returnare salarii angajat
    public function salarii(){
        return $this->hasMany(Salariu::class, 's_angajat', 'id');
    }

    // returnare pontaje angajat
    public function pontaje(){
        return $this->hasMany(Pontaj::class, 'pl_angajat', 'id');
    }

    // returnare metode de plata angajat
    public function metode_plata(){
        return $this->hasMany(DatePlata::class, 'dp_angajat', 'id');
    }

    // returnare calificative
    public function calificative(){
        return $this->hasMany(Calificativ::class, 'ca_angajat', 'id');
    }

    // returnare mcontract angajat
    public function contract(){
        return $this->hasOne(Contract::class, 'c_angajat', 'id');
    }

    // returnare cass angajat
    public function cass(){
        return $this->hasMany(CASS::class, 'sc_angajat', 'id');
    }

    // returnare recompense angajat
    public function recompense(){
        return $this->hasMany(Recompense::class, 'r_angajat_id', 'id');
    }
}
