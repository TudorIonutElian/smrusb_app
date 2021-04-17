<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivIncetareContract extends Model
{
    use HasFactory;
    protected $table="motive_incetare_contract";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
