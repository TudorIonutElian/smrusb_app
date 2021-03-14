<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricInstitutie extends Model
{
    use HasFactory;
    protected $table="istoric_institutii";

    public function get_minister(){
        return $this->belongsTo(Institutii::class, 'id');
    }
}
