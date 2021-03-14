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

    public function showInstitutii(){
        return $this->hasMany('App\Models\Institutii', 'institutie_minister_id');
    }

    public function get_istoric_minister(){
        return $this->hasMany('App\Models\Minister', 'id');
    }
}
