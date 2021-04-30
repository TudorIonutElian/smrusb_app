<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricMutatieProfesionala extends Model
{
    use HasFactory;
    protected $table="istoric_mutatii_profesionale";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
