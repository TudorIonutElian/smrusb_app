<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CASS extends Model
{
    use HasFactory;


    protected $table="salarii_cass";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function salariu(){
        return $this->belongsTo(Salariu::class, 'id');
    }
}
