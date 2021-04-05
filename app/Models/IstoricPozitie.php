<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricPozitie extends Model
{
    use HasFactory;
    protected $table="istoric_pozitii_stat";
    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function pozitie(){
        return $this->belongsTo(PozitiiOrganizare::class, 'ps_pozitie');
    }
}
