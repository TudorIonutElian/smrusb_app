<?php

namespace App\Http\Controllers\Pozitii;

use App\Http\Controllers\Controller;
use App\Http\Resources\DatePosturiVacante;
use App\Http\Resources\DatePozitiiRadiere;
use App\Http\Resources\PozitiiOrganizareDetail;
use App\Models\Cuprins;
use App\Models\Institutii;
use App\Models\IstoricPozitie;
use App\Models\PozitiiOrganizare;
use App\Models\StatOrganizare;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PozitiiController extends Controller
{
    public function preluarePozitiiStat($id){
        $pozitii_stat = PozitiiOrganizare::where([
            ['ps_stat',     '=', $id],
            ['ps_status',   '=', true]

        ])->orderBy('ps_pozitie')->get();
        return PozitiiOrganizareDetail::collection($pozitii_stat);
    }

    public function verificarePozitie($stat, $pozitie){
        // TODO - verificare pozitii active
        $pozitie = count(PozitiiOrganizare::where([
            ['ps_stat', '=', $stat],
            ['ps_pozitie', '=', $pozitie],
            ['ps_status', '=', true]
        ])->get());

        return $pozitie;
    }

    public function suplimentarePozitie(Request $request){

        $pozitie_noua = new PozitiiOrganizare();

        $pozitie_noua->ps_stat          = $request->pozitie['ps_stat'];
        $pozitie_noua->ps_pozitie       = (int) $request->pozitie['ps_pozitie'];
        $pozitie_noua->ps_functie       = $request->pozitie['ps_functie'];
        $pozitie_noua->ps_cuprins       = (int) $request->pozitie['ps_cuprins'];

        if($pozitie_noua->save()){
            return response()->json([
                'cod_raspuns'          => 2000
            ]);
        }else{
            return response()->json([
                'cod_raspuns'          => 4000
            ]);
        }
    }


    public function preluareVacante($cod){
        // Preluare id instituie pe baza codului
        $institutie = Institutii::where('id', '=', $cod)->first();
        $institutie_id = $institutie->id;

        // Preluare stat de organizare pe baza id-ului institutiei
        $stat_organizare = StatOrganizare::where('so_institutie_id', '=', $institutie_id)->first();


        if($stat_organizare){
            $lista_pozitii_vacante = PozitiiOrganizare::where([
                ['ps_stat', '=', $stat_organizare->id],
                ['ps_status', '=', 1],
                ['ps_angajat', '=', null]
            ])->orderBy('ps_pozitie')->get();

//            foreach ($stat_organizare->pozitii as $pozitie){
//                if($pozitie['ps_angajat'] === null){
//                    array_push($lista_pozitii_vacante, $pozitie);
//                }
//            }
            return $lista_pozitii_vacante;
        }
    }

    public function preluareVacanteStat($cod){
        // Preluare id instituie pe baza codului
        $institutie = Institutii::where('id', '=', $cod)->first();
        $institutie_id = $institutie->id;

        // Preluare stat de organizare pe baza id-ului institutiei
        $stat_organizare = StatOrganizare::where('so_institutie_id', '=', $institutie_id)->first();
        $lista_pozitii_vacante = [];

        if($stat_organizare){
            foreach ($stat_organizare->pozitii as $pozitie){
                if($pozitie['ps_angajat'] === null){
                    array_push($lista_pozitii_vacante, $pozitie);
                }
            }
            return DatePosturiVacante::collection($lista_pozitii_vacante);
        }
    }

    public function preluareRadiere($cod_institutie){
        $institutie = Institutii::find($cod_institutie);
        $pozitii_radiere = PozitiiOrganizare::where([
            'ps_stat'       => $institutie->stat->id,
            'ps_angajat'    => null,
            'ps_status'     => 1
        ])->get();


        return DatePozitiiRadiere::collection($pozitii_radiere);
    }

    public function pozitieRadiere(Request $request){
        $pozitie_radiere = PozitiiOrganizare::find($request->pozitie_id);
        $pozitie_radiere->ps_status = false;
        $pozitie_radiere->ps_data_radiere = Carbon::now();

        $pozitie_radiere->save();
    }
}
