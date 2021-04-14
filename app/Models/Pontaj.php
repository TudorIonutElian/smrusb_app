<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pontaj extends Model
{
    use HasFactory;
    protected $table="pontaj_lunar";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function institutie(){
        return $this->belongsTo(Institutii::class, 'pl_institutie', 'id');
    }

    public function angajat(){
        return $this->belongsTo(Angajat::class, 'pl_angajat', 'id');
    }
}
