<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionarRecompense extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table="dc_recompense";
    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
