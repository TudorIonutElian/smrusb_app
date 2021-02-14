<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judet extends Model
{
    use HasFactory;
    protected $table="judete";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function getRegiune(){
        return $this->belongsTo(Regiune::class, 'regiune');
    }
}
