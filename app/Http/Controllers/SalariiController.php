<?php

namespace App\Http\Controllers;

use App\Http\Resources\DatePozitiiSalarii;
use App\Http\Resources\DateSalariiInstitutie;
use App\Models\Angajat;
use App\Models\CASS;
use App\Models\DateBanca;
use App\Models\DatePlata;
use App\Models\Institutii;
use App\Models\Pontaj;
use App\Models\PozitiiOrganizare;
use App\Models\Salariu;
use App\Models\StatOrganizare;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

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

    public function vizualizare($institutie, $dela, $panala){
        if(
            // Verificare daca ambele date sunt setate
            (isset($dela) && $dela != 'null') &&
            (isset($dela) && $panala != 'null')
        ){
            return DateSalariiInstitutie::collection(
                Salariu::where([
                    ['s_institutie', '=', $institutie],
                    ['s_start_date', '>=', $dela],
                    ['s_end_date',   '<=', $panala],
                ])->orderBy('s_start_date')->get()
            );
        }else if(
            // Verificare daca prima data data este setata
            (isset($dela) && $dela != 'null') &&
            (isset($dela) && $panala == 'null')
        ){
            return DateSalariiInstitutie::collection(
                Salariu::where([
                    ['s_institutie', '=', $institutie],
                    ['s_start_date', '>=', $dela]
                ])->orderBy('s_start_date')->get()
            );
        }else if(
            // Verificare daca prima data data este setata
            (isset($dela) && $dela == 'null') &&
            (isset($dela) && $panala != 'null')
        ){
            return DateSalariiInstitutie::collection(
                Salariu::where([
                    ['s_institutie', '=', $institutie],
                    ['s_end_date',   '<=', $panala]
                ])->orderBy('s_start_date')->get()
            );
        }else{
            return DateSalariiInstitutie::collection(
                Salariu::where(
                    's_institutie', '=', $institutie
                )->orderBy('s_start_date')->get()
            );
        }
    }

    public function generareSalariu(Request $request){
        $stat       = StatOrganizare::where('so_institutie_id', '=', $request->institutie)->first();

        $pozitie    = PozitiiOrganizare::where([
            ['ps_stat',     '=', $stat->id],
            ['ps_pozitie',  '=', $request->pozitie]
        ])->first();

        // TODO - verificare pontaj angajat
        $pontaj = Pontaj::where([
            ['pl_institutie',   '=', $request->institutie],
            ['pl_pozitie',      '=', $request->pozitie],
            ['pl_angajat',      '=', $pozitie->angajat['id']],
            ['pl_start_date',   '=', Carbon::now()->startOfMonth()]
        ])->first();

        if(!$pontaj){
            return response()->json([
                'code_message' => 'pontaj_inexistent'
            ]);
        }else{
            if(!isEmpty($pontaj) || is_null($pontaj)){
                return response()->json([
                    'code_message' => 'eroare_pontaj'
                ]);
            }else{
                // Verificare daca pontajul este aprobat
                if($pontaj->pl_este_aprobat === true || $pontaj->pl_este_aprobat === 1){
                    $salariu = new Salariu();
                    $salariu->s_institutie      = Institutii::find($request->institutie)->id;
                    $salariu->s_angajat         = $pozitie->ps_angajat;
                    $salariu->s_functie         = $pozitie->functie->id;
                    $salariu->s_stat            = $stat->id;
                    $salariu->s_pozitie         = $pozitie->ps_pozitie;
                    $salariu->s_start_date      = Carbon::now()->startOfMonth();
                    $salariu->s_end_date        = Carbon::now()->endOfMonth();
                    $salariu->s_suma_initiala   = $pozitie->functie->functie_suma;
                    $salariu->s_bonus           = 0;
                    $salariu->s_suma_finala     = $pozitie->functie->functie_suma;
                    $salariu->s_achitat         = false;
                    $salariu->s_tip_achitare    = 0;

                    $salariu->save();

                    return $salariu;
                }else{
                    return response()->json([
                        'code_message' => 'pontaj_neaprobat'
                    ]);
                }
            }
        }
    }
    public function preluareDateBanci(){
        return DateBanca::all('id', 'db_denumire')->sortBy('db_denumire');
    }

    public function achitareSalariu(Request $request){
        $salariu = Salariu::find($request->salariu[0]['id']);
        $salariu->s_achitat = 1;
        $salariu->s_data_achitarii  = Carbon::now();

        if($salariu->save()){
            $cass = new CASS();
            $cass->sc_salariu_id    = $salariu->id;
            $cass->sc_institutie    = $salariu->institutie->id;
            $cass->sc_angajat       = $salariu->angajat->id;
            $cass->sc_cass          = 5.55;
            $cass->sc_suma          = ($salariu->s_suma_finala * 0.55);

            $cass->save();

            return response()->json([
                'code_message' => 'salariu_achitat'
            ]);
        }
        return $salariu;
    }
}
