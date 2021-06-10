<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanctiuni extends Model
{
    use HasFactory;

    protected $table="sanctiuni";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
