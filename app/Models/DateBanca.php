<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateBanca extends Model
{
    use HasFactory;

    protected $table="date_banci";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;
}
