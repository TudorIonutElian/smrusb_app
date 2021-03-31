<?php

namespace App\Http\Controllers\Pozitii;

use App\Http\Controllers\Controller;
use App\Http\Resources\PozitiiOrganizareDetail;
use App\Models\PozitiiOrganizare;
use Illuminate\Http\Request;

class PozitiiController extends Controller
{
    public function preluarePozitiiStat($id){
        $pozitii_stat = PozitiiOrganizare::where('ps_stat', '=', $id)->get();
        return PozitiiOrganizareDetail::collection($pozitii_stat);
    }

    public function verificarePozitie($stat, $pozitie){
        $pozitie = count(PozitiiOrganizare::where([
            ['ps_stat', '=', $stat],
            ['ps_pozitie', '=', $pozitie]
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
}
