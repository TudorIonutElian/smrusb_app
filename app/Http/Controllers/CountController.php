<?php

namespace App\Http\Controllers;

use App\Models\Calificativ;
use App\Models\IstoricMutatieProfesionala;
use App\Models\MutatiiProfesionale;
use App\Models\Pontaj;
use App\Models\Recompense;
use App\Models\Salariu;
use Illuminate\Http\Request;

class CountController extends Controller
{
    //
    public function countSalarii($id){
        return count(Salariu::where('s_angajat', '=', $id)->get());
    }

    public function countPontaje($id){
        return count(Pontaj::where('pl_angajat', '=', $id)->get());
    }

    public function countCalificative($id){
        return count(Calificativ::where('ca_angajat', '=', $id)->get());
    }

    public function countRecompense($id){
        return count(Recompense::where('r_angajat_id', '=', $id)->get());
    }

    public function countMutatii($id){
        return count(IstoricMutatieProfesionala::where('imp_angajat_id', '=', $id)->get());
    }

}
