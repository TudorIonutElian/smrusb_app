<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institutii extends Model
{
    use HasFactory;
    protected $table="institutii";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function showMinister(){
        return $this->belongsTo(Minister::class, 'institutie_minister_id', 'id');
    }

    public function get_istoric_institutie(){
        return $this->hasMany('App\Models\IstoricInstitutie', 'id');
    }

    public function stat(){
        return $this->hasOne(StatOrganizare::class, 'so_institutie_id', 'id');
    }

    public function mutatii(){
        return $this->hasMany(MutatiiProfesionale::class, 'id');
    }
}
