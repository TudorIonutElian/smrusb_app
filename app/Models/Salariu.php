<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salariu extends Model
{
    use HasFactory;

    protected $table="salarii";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->belongsTo(Angajat::class, 's_angajat', 'id');
    }

    public function institutie(){
        return $this->belongsTo(Institutii::class, 's_institutie', 'id');
    }

    public function functie(){
        return $this->belongsTo(Functii::class, 's_functie', 'id');
    }

    public function pozitie(){
        return $this->belongsTo(PozitiiOrganizare::class, 'id');
    }

    public function cass(){
        return $this->hasOne(CASS::class, 'sc_salariu_id', 'id');
    }
}
