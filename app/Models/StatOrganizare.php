<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatOrganizare extends Model
{
    use HasFactory;

    protected $table="stat_organizare";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    // Returnare Institutie->stat de organizare
    public function institutie(){
        return $this->belongsTo(Institutii::class, 'so_institutie_id');
    }

    public function pozitii(){
        return $this->hasMany(PozitiiOrganizare::class, 'ps_stat', 'id')->where(['ps_status' => true]);
    }
}
