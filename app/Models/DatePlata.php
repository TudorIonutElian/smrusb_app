<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatePlata extends Model
{
    use HasFactory;

    protected $table="date_plata";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->hasOne(Angajat::class, 'id');
    }

    public function banca(){
        return $this->hasOne(DateBanca::class, 'id', 'dp_banca');
    }
}
