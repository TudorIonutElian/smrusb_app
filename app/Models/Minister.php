<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minister extends Model
{
    use HasFactory;

    protected $table="ministere";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
