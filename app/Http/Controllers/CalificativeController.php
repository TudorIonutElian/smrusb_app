<?php

namespace App\Http\Controllers;

use App\Http\Resources\DateCalificativeAngajat;
use App\Models\Calificativ;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalificativeController extends Controller
{
    public function preluareContestatiiSpecialist($institutie_id){
        return DateCalificativeAngajat::collection(Calificativ::where([
            ['ca_institutie',       '=', $institutie_id],
            ['ca_status',           '=', 0],
            ['ca_are_contestatie',  '=', 1]
        ])->get());
    }
    public function contestaCalificativ(Request $request){
        $id_calificativ                                 = $request->id;
        $calificativ_identificat                        = Calificativ::find($id_calificativ);
        $calificativ_identificat->ca_are_contestatie    = 1;

        if($calificativ_identificat->save()){
            return response()->json([
                'operation_result' => 'succes'
            ]);
        }
    }
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
            ['ca_status',           '=', 0],
            ['ca_are_contestatie',   '=', 0]
        ])->get());
    }

    public function aprobareCalificativ(Request $request){
        $id = $request->idCalificativ;
        $calificativ = Calificativ::find($id);
        $calificativ->ca_calificativ_final  = $request->calificativFinalAprobat;
        $calificativ->ca_aprobat_by         = $request->user_id;
        $calificativ->ca_status             = 1;

        if($calificativ->save()){
            return response()->json([
                'cod_message' => 2000
            ]);
        }
    }
    public function aprobareCalificativFaraContestatie(Request $request){
        $id = $request->idCalificativ;
        $calificativ = Calificativ::find($id);
        $calificativ->ca_calificativ_final  = $request->calificativ_final;
        $calificativ->ca_aprobat_by         = $request->user_id;
        $calificativ->ca_status             = 1;

        if($calificativ->save()){
            return response()->json([
                'cod_message' => 2000
            ]);
        }
    }
}
