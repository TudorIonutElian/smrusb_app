<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricMinister extends Model
{
    use HasFactory;
    protected $table="istoric_ministere";

    public function get_minister(){
        return $this->belongsTo(Minister::class, 'id');
    }
}
