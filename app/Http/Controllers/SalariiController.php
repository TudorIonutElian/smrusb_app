<?php

namespace App\Http\Controllers;

use App\Http\Resources\DatePozitiiSalarii;
use App\Http\Resources\DateSalariiAngajat;
use App\Http\Resources\DateSalariiInstitutie;
use App\Models\Institutii;
use App\Models\PozitiiOrganizare;
use App\Models\Salariu;
use App\Models\StatOrganizare;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalariiController extends Controller
{
    public function generare($cod){
        // identificare stat
        $stat_organizare = StatOrganizare::where('so_institutie_id', '=', $cod)->first();

        $pozitii_stat = PozitiiOrganizare::where([
            ['ps_stat',      '=',    $stat_organizare->id],
            ['ps_angajat',   '!=',   null]
        ])->get();

        return DatePozitiiSalarii::collection($pozitii_stat);
    }

    public function vizualizare($cod){
        return DateSalariiInstitutie::collection(Salariu::where('s_institutie', '=', $cod)->orderBy('s_start_date')->get());
    }

    public function generareSalariu(Request $request){
        $stat       = StatOrganizare::where('so_institutie_id', '=', $request->institutie)->first();

        $pozitie    = PozitiiOrganizare::where([
            ['ps_stat',     '=', $stat->id],
            ['ps_pozitie',  '=', $request->pozitie]
        ])->first();

        $salariu = new Salariu();
        $salariu->s_institutie      = Institutii::find($request->institutie)->id;
        $salariu->s_angajat         = $pozitie->ps_angajat;
        $salariu->s_functie         = $pozitie->functie->id;
        $salariu->s_stat            = $stat->id;
        $salariu->s_pozitie         = $pozitie->ps_pozitie;
        $salariu->s_start_date      = Carbon::now();
        $salariu->s_end_date        = Carbon::now()->endOfMonth();
        $salariu->s_suma_initiala   = $pozitie->functie->functie_suma;
        $salariu->s_bonus           = 0;
        $salariu->s_suma_finala     = $pozitie->functie->functie_suma;
        $salariu->s_achitat         = false;
        $salariu->s_tip_achitare    = 0;

        $salariu->save();
    }
}
