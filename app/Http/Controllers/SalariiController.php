<?php

namespace App\Http\Controllers;

use App\Http\Resources\CassResource;
use App\Http\Resources\DatePozitiiSalarii;
use App\Http\Resources\DateSalariiInstitutie;
use App\Models\Angajat;
use App\Models\CASS;
use App\Models\DateBanca;
use App\Models\DatePlata;
use App\Models\Institutii;
use App\Models\PlatiCass;
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
    public function achitareCass(Request $request){
        $id_cass_neachitat                  = $request->id;
        $cass_identificat                   = CASS::find($id_cass_neachitat);
        $cass_identificat->sc_achitat       = 1;
        if($cass_identificat->save()){
            $plata_cass                     = new PlatiCass();
            $plata_cass->pc_salariu         = $cass_identificat->salariu->id;
            $plata_cass->pc_taxa            = 5.55;
            $plata_cass->pc_valoare         = $cass_identificat->sc_suma;
            $plata_cass->pc_numar_zile      = 10;
            $plata_cass->pc_platit          = 1;

            if($plata_cass->save()){
                return 'plata_efectuata';
            }
        }
    }
    public function preluareCassAchitat($institutie, $startdate, $enddate){
        if($startdate == "null" && $enddate == "null"){

            return CassResource::collection(CASS::where([
                ['sc_institutie',   '=', $institutie],
                ['sc_achitat',      '=', 1]
            ])->get());

        }elseif($startdate !== "null" && $enddate == "null"){

            // returnare doar pe baza startdate
            return CassResource::collection(CASS::where([
                ['sc_institutie',   '=', $institutie],
                ['sc_start_date',   '>=', $startdate],
                ['sc_achitat',      '=', 1]
            ])->get());

        }else{
            // returnare pe baza tuturor elementelor
            return CassResource::collection(CASS::where([
                ['sc_institutie',   '=', $institutie],
                ['sc_start_date',   '>=', $startdate],
                ['sc_end_date',     '<=', $enddate],
                ['sc_achitat',      '=', 1]
            ])->get());
        }
    }
    public function preluareCassNeachitat($institutie, $startdate, $enddate){
        if($startdate == "null" && $enddate == "null"){

            return CassResource::collection(CASS::where([
                ['sc_institutie',   '=', $institutie],
                ['sc_achitat',      '=', 0]
            ])->get());

        }elseif($startdate !== "null" && $enddate == "null"){

            // returnare doar pe baza startdate
            return CassResource::collection(CASS::where([
                ['sc_institutie',   '=', $institutie],
                ['sc_start_date',   '>=', $startdate],
                ['sc_achitat',      '=', 0]
            ])->get());

        }else{
            // returnare pe baza tuturor elementelor
            return CassResource::collection(CASS::where([
                ['sc_institutie',   '=', $institutie],
                ['sc_start_date',   '>=', $startdate],
                ['sc_end_date',     '<=', $enddate],
                ['sc_achitat',      '=', 0]
            ])->get());
        }
    }
    public function preluareSalariiByCNP($codnumericpersonal){
        $angajat = Angajat::where('angajat_cnp', '=', $codnumericpersonal)->first();
        $salarii = Salariu::where('s_angajat', '=', $angajat->id)->get();

        return $salarii;
    }
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
            $cass->sc_suma          = ($salariu->s_suma_finala * 0.055);
            $cass->sc_start_date    = ($salariu->s_start_date);
            $cass->sc_end_date      = ($salariu->s_end_date);

            $cass->save();

            return response()->json([
                'code_message' => 'salariu_achitat'
            ]);
        }
        return $salariu;
    }

    public function preluareSalariiLunar($institutie_id, $luna){
        $anul = Carbon::now()->format('Y');
        $perioada = null;

        switch ($luna){
            case '01':
                $perioada = [
                  'start_date'  => Carbon::createFromFormat('d-m-Y', '01-01-'.$anul),
                  'end_date'    => Carbon::createFromFormat('d-m-Y', '31-01-'.$anul),
                ];
               break;
            case '02':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-02-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '28-02-'.$anul),
                ];
                break;
            case '03':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-03-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-03-'.$anul),
                ];
                break;
            case '04':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-04-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-04-'.$anul),
                ];
                break;
            case '05':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-05-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-05-'.$anul),
                ];
                break;
            case '06':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-06-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-06-'.$anul),
                ];
                break;
            case '07':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-07-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-07-'.$anul),
                ];
                break;
            case '08':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-08-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-08-'.$anul),
                ];
                break;
            case '09':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-09-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-09-'.$anul),
                ];
                break;
            case '10':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-10-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-10-'.$anul),
                ];
                break;
            case '11':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-11-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-11-'.$anul),
                ];
                break;
            case '12':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-12-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-12-'.$anul),
                ];
                break;
        }
        $salarii = Salariu::where([
            ['s_institutie', '=', $institutie_id,],
            ['s_start_date', '=', $perioada['start_date']->format('Y-m-d')],
            ['s_end_date',   '=', $perioada['end_date']->format('Y-m-d')],
        ])->get();

        return DateSalariiInstitutie::collection($salarii);
    }

    public function preluareSalariiTrimestrial($institutie_id, $trimestru){
        $anul = Carbon::now()->format('Y');
        $perioada = null;

        switch ($trimestru){
            case '01':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-01-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-03-'.$anul),
                ];
                break;
            case '02':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-04-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-06-'.$anul),
                ];
                break;
            case '03':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-07-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-09-'.$anul),
                ];
                break;
            case '04':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-10-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-12-'.$anul),
                ];
                break;
        }

        $salarii = Salariu::where([
            ['s_institutie', '=', $institutie_id,],
            ['s_start_date', '>=', $perioada['start_date']->format('Y-m-d')],
            ['s_end_date',   '<=', $perioada['end_date']->format('Y-m-d')],
        ])->get();

        return [
            'salarii'   => DateSalariiInstitutie::collection($salarii),
            'sumar'     => 0
        ];
    }

    public function preluareSalariiSemestrial($institutie_id, $semestru){
        $anul = Carbon::now()->format('Y');
        $perioada = null;
        $sumar = 0;

        switch ($semestru){
            case '01':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-01-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '30-06-'.$anul),
                ];
                break;
            case '02':
                $perioada = [
                    'start_date'  => Carbon::createFromFormat('d-m-Y', '01-07-'.$anul),
                    'end_date'    => Carbon::createFromFormat('d-m-Y', '31-12-'.$anul),
                ];
                break;
        }

        $salarii = Salariu::where([
            ['s_institutie', '=', $institutie_id,],
            ['s_start_date', '>=', $perioada['start_date']->format('Y-m-d')],
            ['s_end_date',   '<=', $perioada['end_date']->format('Y-m-d')],
        ])->get();

        return [
            'salarii'   => DateSalariiInstitutie::collection($salarii),
            'sumar'     => 0
        ];
    }

    public function preluareSalariiAnual($institutie_id, $an){
        $perioada = [
            'start_date'  => Carbon::createFromFormat('d-m-Y', '01-01-'.$an),
            'end_date'    => Carbon::createFromFormat('d-m-Y', '31-12-'.$an),
        ];

        $salarii = Salariu::where([
            ['s_institutie', '=', $institutie_id,],
            ['s_start_date', '>=', $perioada['start_date']->format('Y-m-d')],
            ['s_end_date',   '<=', $perioada['end_date']->format('Y-m-d')],
        ])->get();

        return [
            'salarii'   => DateSalariiInstitutie::collection($salarii),
            'sumar'     => 0
        ];
    }
}
