<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricRegiune extends Model
{
    use HasFactory;

    protected $table="istoric_regiuni";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
