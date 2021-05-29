<?php

namespace App\Http\Controllers;

use App\Http\Resources\DateCalificativeAngajat;
use App\Models\Calificativ;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalificativeController extends Controller
{
    public function preluareByID($angajat_id){
        return DateCalificativeAngajat::collection(Calificativ::where('ca_angajat', '=', $angajat_id)->get());
    }

    public function preluareNeaprobate($institutie_id){
        return DateCalificativeAngajat::collection(Calificativ::where([
            ['ca_institutie',       '=', $institutie_id],
            ['ca_status',           '=', 0],
            ['ca_data_adaugarii',   '<=', Carbon::now()->subDays(6)]
        ])->get());
    }

    public function preluareNeaprobateSpecialist($institutie_id){
        return DateCalificativeAngajat::collection(Calificativ::where([
            ['ca_institutie',       '=', $institutie_id],
            ['ca_status',           '=', 0]
        ])->get());
    }

    public function aprobareCalificativ(Request $request){
        $id = $request->idCalificativ;
        $calificativ = Calificativ::find($id);
        $calificativ->ca_calificativ_final  = $request->calificativFinal;
        $calificativ->ca_aprobat_by         = $request->user_id;
        $calificativ->ca_status             = 1;

        if($calificativ->save()){
            return response()->json([
                'cod_message' => 2000
            ]);
        }
    }
}
