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
}
