<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricUser extends Model
{
    use HasFactory;
    protected $table="istoric_users";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function get_user(){
        return $this->belongsTo(User::class, 'iu_user');
    }
}
