<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatiCass extends Model
{
    use HasFactory;

    protected $table="plati_cass";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
