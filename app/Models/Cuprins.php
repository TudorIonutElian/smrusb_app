<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuprins extends Model
{
    use HasFactory;

    protected $table="stat_cuprins";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function institutie(){
        return $this->belongsTo(Institutii::class, 'sc_institutie');
    }
    public function pozitii(){
        return $this->hasMany(PozitiiOrganizare::class, 'ps_cuprins', 'id');
    }

    public function mutatii(){
        return $this->hasMany(MutatiiProfesionale::class, 'mp_cuprins_id', 'id');
    }
}
