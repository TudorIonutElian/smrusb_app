<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiune extends Model
{
    use HasFactory;

    protected $table="regiuni";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function getJudete(){
        return $this->hasMany(Judet::class, 'id');
    }
}
