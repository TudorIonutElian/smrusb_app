<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractIstoric extends Model
{
    use HasFactory;
    protected $table="contracte_istoric";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function contract(){
        return $this->belongsTo(Contract::class, 'id');
    }
}
