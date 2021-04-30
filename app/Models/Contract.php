<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table="contracte";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->belongsTo(Angajat::class, 'id');
    }
}
