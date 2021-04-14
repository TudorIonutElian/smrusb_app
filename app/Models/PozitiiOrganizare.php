<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PozitiiOrganizare extends Model
{
    use HasFactory;

    protected $table="pozitii_stat";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    // returnare stat de organizare
    public function stat(){
        return $this->belongsTo(StatOrganizare::class, 'ps_stat', 'id');
    }

    // returnare angajat
    public function angajat(){
        return $this->hasOne(Angajat::class, 'id', 'ps_angajat');
    }

    // returnare functie
    public function functie(){
        return $this->hasOne(Functii::class, 'id', 'ps_functie');
    }
    public function mutatii(){
        return $this->hasMany(MutatiiProfesionale::class, 'mp_pozitie_id', 'id');
    }

    public function cuprins(){
        return $this->hasOne(Cuprins::class, 'id', 'ps_cuprins');
    }

    public function istoric(){
        return $this->hasMany(IstoricPozitie::class, 'ips_pozitie', 'ps_pozitie');
    }

    public function salarii(){
        return $this->hasMany(Salariu::class, 's_pozitie', 'id')
            ->where([
                ['s_stat', '=', $this->stat->id]
            ]);
    }
    public function salariu_generat(){
        return $this->hasMany(Salariu::class, 's_pozitie', 'ps_pozitie')
            ->where([
                ['s_pozitie', '=', $this->ps_pozitie],
                ['s_stat',    '=', $this->stat->id ]
            ])
            ->whereDate('s_end_date', '=', Carbon::now()->endOfMonth());
    }

}
