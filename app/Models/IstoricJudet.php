<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricJudet extends Model
{
    use HasFactory;
    protected $table="istoric_judete";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
