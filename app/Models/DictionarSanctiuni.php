<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionarSanctiuni extends Model
{
    use HasFactory;

    protected $table="dc_sanctiuni";
    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
