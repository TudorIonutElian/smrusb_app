<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionarCalificativ extends Model
{
    use HasFactory;
    protected $table="dc_calificative";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function calificative(){
        return $this->hasMany(Calificativ::class, 'dc_calificativ_initial', 'id');
    }
}
