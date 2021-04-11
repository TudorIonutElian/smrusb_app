<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutatiiProfesionale extends Model
{
    use HasFactory;

    protected $table="mutatii_profesionale";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->hasOne(Angajat::class, 'id', 'mp_angajat_id');
    }
    public function institutie(){
        return $this->hasOne(Institutii::class, 'id', 'mp_institutie_id');
    }

    public function functie(){
        return $this->hasOne(Functii::class, 'id', 'mp_functie_id');
    }

    public function pozitie(){
        return $this->hasOne(PozitiiOrganizare::class, 'id', 'mp_pozitie_id');
    }

    public function cuprins(){
        return $this->hasMany(Cuprins::class, 'id', 'mp_cuprins_id');
    }

}
