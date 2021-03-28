<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessLevel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_access';

    public function get_user(){
        return $this->belongsTo('App\Models\User', 'ua_user', 'id');
    }

    public function get_user_acces_denumire_institutie(){
        return $this->hasMany('App\Models\Institutii', 'ua_level');
    }
}
