<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificativ extends Model
{
    use HasFactory;

    protected $table="angajati_calificative";

    // Anulare coloane created_at si updated_at
    public $timestamps = false;

    public function angajat(){
        return $this->belongsTo(Angajat::class, 'ca_angajat');
    }

    public function institutie(){
        return $this->belongsTo(Institutii::class, 'ca_institutie');
    }

    public static function getDenumireCalificativ($id){
        return DictionarCalificativ::where('id', '=', $id)->first()['dc_denumire'];
    }

    public static function getStatusCalificativ($status){
        if($status === 0){
            return 'Calificativ Neaprobat';
        }else if ($status === 1){
            return 'Calificativ Aprobat';
        }
    }
}
