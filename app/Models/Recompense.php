<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recompense extends Model
{
    use HasFactory;

    protected $table="recompense";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->belongsTo(Angajat::class, 'r_angajat_id');
    }

    public function dictionar(){
        return $this->belongsTo(DictionarRecompense::class, 'r_recompensa_id');
    }
}
