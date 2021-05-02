<?php

namespace App\Http\Controllers;

use App\Http\Resources\DateAngajatiUserDashboard;
use App\Http\Resources\DateAngajatMutare;
use App\Http\Resources\DateAngajatNumire;
use App\Http\Resources\DateCalificativeAngajat;
use App\Http\Resources\DatePersonaleAngajat;
use App\Http\Resources\DateSalariiAngajat;
use App\Http\Resources\MutatiiAngajat;
use App\Models\Angajat;
use App\Models\Calificativ;
use App\Models\Contract;
use App\Models\DatePlata;
use App\Models\Institutii;
use App\Models\MutatiiProfesionale;
use App\Models\PozitiiOrganizare;
use App\Models\Salariu;
use App\Models\StatOrganizare;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AngajatiController extends Controller
{
    public function preluareInstitutie($id){
        $institutie = Institutii::find($id);
        return $institutie;
    }
    public function adauga(Request $request){
        // Preluare CNP de la utilizator
        $verificare_cnp = $request->angajat['cnp'];

        // Verificare CNP
        $angajat_existent = Angajat::where('angajat_cnp', '=', $verificare_cnp)->get();

        // Verificare daca obiectul returnat este gol sau nu
        if(!$angajat_existent->isEmpty()){
            return response()->json([
                'cod'           => '000',
                'status'        => 403
            ]);
        }else{

            $angajat = new Angajat();

            $angajat->angajat_nume                                      = $request->angajat['nume'];
            $angajat->angajat_prenume_tata                              = $request->angajat['prenume_tata'];
            $angajat->angajat_prenume_mama                              = $request->angajat['prenume_mama'];
            $angajat->angajat_prenume                                   = $request->angajat['prenume'];
            $angajat->angajat_cnp                                       = $request->angajat['cnp'];
            $angajat->angajat_nume_anterior                             = $request->angajat['nume_anterior'];
            $angajat->angajat_data_nasterii                             = $request->angajat['data_nasterii'];
            $angajat->angajat_stare_civila                              = $request->angajat['stare_civila'];
            $angajat->angajat_cod_acces                                 = Institutii::where('id', '=', $request->angajat['acces_level'])->first()['institutie_cod_acces'];
            $angajat->angajat_judet_nastere                             = $request->angajat['judet_nastere'];
            $angajat->angajat_localitate_nastere                        = $request->angajat['localitate_nastere'];
            $angajat->angajat_functie_curenta                           = NULL;
            $angajat->angajat_institutie_curenta                        = $request->angajat['acces_level'];

            if($angajat->save()){

                // Salvare mutatie profesionala
                $mutatie_profesionala = new MutatiiProfesionale();
                $mutatie_profesionala->mp_act_numar                     = $request->angajat['numar_act_angajare'];
                $mutatie_profesionala->mp_act_data_emitere              = $request->angajat['data_emitere_act_angajare'];
                $mutatie_profesionala->mp_act_data_aplicare             = $request->angajat['data_aplicare_act_angajare'];
                $mutatie_profesionala->mp_institutie_id                 = $request->angajat['acces_level'];
                $mutatie_profesionala->mp_angajat_id                    = $angajat->id;
                $mutatie_profesionala->mp_cuprins_id                    = null;
                $mutatie_profesionala->mp_fel_numire_id                 = 5;
                $mutatie_profesionala->mp_pozitie_id                    = null;
                $mutatie_profesionala->mp_functie_id                    = null;

                $mutatie_profesionala->save();

                $user = new User();
                $user->user_first_name      = $angajat->angajat_nume;
                $user->user_last_name       = $angajat->angajat_prenume;
                $user->user_email           = trim(strtolower($angajat->angajat_prenume).strtolower($angajat->angajat_nume).'@smrusb.ro');

                // Prelucrare username
                $user_username_generat      = trim('angajat_'.strtolower($angajat->angajat_prenume).strtolower($angajat->angajat_nume));
                $user->user_username        = $angajat->angajat_cnp;

                $user->user_password        = Hash::make('password');
                $user->remember_token       = Str::random(10);
                $user->user_is_active       = false;
                $user->user_type            = 3;
                $user->user_cod_acces       = $angajat->angajat_cod_acces;
                $user->user_angajat_id      = $angajat->id;
                $user->user_added_by      = $request->angajat['user_added_by'];

                if($user->save()){
                    // Salvare contract
                    $this::salvareContract($angajat, 1, $request->angajat['data_aplicare_act_angajare']);

                    return response()->json([
                        'cod'     => '001',
                        'status'       => 200
                    ]);
                }
            }else{
                return $request;
            }
        }
    }

    public function preluare($id){
        $user = User::find($id);

        $user_acces = $user->get_user_acces;
        $lista_acces = [];
        foreach ($user_acces as $acces_level){
            if($acces_level->ua_status === 1){
                array_push($lista_acces, $acces_level->ua_level);
            }
        }

        // Identificare angajati
        $angajati = Angajat::whereIn('angajat_cod_acces', $lista_acces)->get();
        return DateAngajatiUserDashboard::collection($angajati);
    }

    // Preluare angajat care au contractul activ
    public function angajatiPreluareIncetare($user_id){
        $user = User::find($user_id);

        $user_acces = $user->get_user_acces;
        $lista_acces = [];
        foreach ($user_acces as $acces_level){
            if($acces_level->ua_status === 1){
                array_push($lista_acces, $acces_level->ua_level);
            }
        }

        // Identificare angajati
        $angajati = Angajat::whereIn('angajat_cod_acces', $lista_acces)->get();
        return DateAngajatiUserDashboard::collection($angajati);
    }

    // Preluare date angajat pentru fisa de evidenta
    public function fisaEvidenta($id){
        return [
            'date_personale'        => DatePersonaleAngajat::make(Angajat::find($id)),
            'date_mutatii'          => MutatiiAngajat::collection(MutatiiProfesionale::where('mp_angajat_id', '=', $id)->orderBy('mp_act_data_aplicare')->get()),
            'date_salarii'          => DateSalariiAngajat::collection(Salariu::where('s_angajat', '=', Angajat::find($id)->id)->get()),
            'adresa'                => Angajat::find($id)->adresa,
            'evaluari'              => DateCalificativeAngajat::collection(Calificativ::where('ca_angajat', '=', Angajat::find($id)->id)->get())

        ];
    }

    // Numire angajat
    public function numireAngajat($id, Request $request){
        // Identificare Angajat
        $angajat = Angajat::find($id);

        // Identificare institutie unde este numite angajatul
        $institutie = Institutii::where('id', '=', $angajat->angajat_institutie_curenta)->first();

        // Setare conditii pentru identificare stat de organizare
        $conditii_stat = [
            'so_institutie_id' => $institutie->id
        ];

        // Identificare stat de organizare
        $stat_unde_este_numit = StatOrganizare::where($conditii_stat)->first();

        // Setare conditii pentur identificare pozitie veche
        $conditii_pozitie_veche = [
            'ps_stat' => $stat_unde_este_numit->id,
            'ps_angajat' =>$angajat->id
        ];

        // Identificare pozitie veche
        $pozitie_veche = PozitiiOrganizare::where($conditii_pozitie_veche)->first();

        if(!empty($pozitie_veche)){
            $pozitie_veche->ps_angajat = null;
            $pozitie_veche->ps_data_emitere = null;
            $pozitie_veche->ps_data_numire = null;
            $pozitie_veche->ps_numar_act = null;

            $pozitie_veche->save();
        }

        // Identificare Pozitie Noua
        $stat_nou = StatOrganizare::where('so_institutie_id', '=', $request->date_numire['numire_stat'])->first();

        $pozitie_noua = PozitiiOrganizare::where([
            'ps_stat'       => $stat_nou->id,
            'ps_pozitie'    => $request->date_numire['numire_pozitie']
        ])->first();

        $pozitie_noua->ps_angajat                = $angajat->id;
        $pozitie_noua->ps_data_numire            = $request->date_numire['numire_act_aplicare'];
        $pozitie_noua->ps_data_emitere           = $request->date_numire['numire_act_emitere'];
        $pozitie_noua->ps_numar_act              = $request->date_numire['numire_act'];

        $pozitie_noua->save();
        $angajat->angajat_functie_curenta = $pozitie_noua->ps_functie;
        $angajat->angajat_pozitie_curenta = $pozitie_noua->id;
        $angajat->save();

        // Salvare mutatie profesionala
        $mutatie_profesionala = new MutatiiProfesionale();
        $mutatie_profesionala->mp_act_numar                     = $pozitie_noua->ps_numar_act;
        $mutatie_profesionala->mp_act_data_emitere              = $pozitie_noua->ps_data_emitere;
        $mutatie_profesionala->mp_act_data_aplicare             = $pozitie_noua->ps_data_numire;
        $mutatie_profesionala->mp_institutie_id                 = $institutie->id;
        $mutatie_profesionala->mp_angajat_id                    = $angajat->id;
        $mutatie_profesionala->mp_cuprins_id                    = $pozitie_noua->ps_cuprins;
        $mutatie_profesionala->mp_fel_numire_id                 = 0;
        $mutatie_profesionala->mp_pozitie_id                    = $pozitie_noua->ps_pozitie;
        $mutatie_profesionala->mp_functie_id                    = $pozitie_noua->ps_functie;

        $mutatie_profesionala->save();
    }

    // Preluare date angajat la mutare
    public function preluareAngajatMutare($id){
        $angajat = Angajat::find($id);

        $institutie = Institutii::where('institutie_cod_acces', '=', $angajat->angajat_cod_acces)->get();
        $functie = 'Nu este numit';

        return response()->json(
            [
                'angajat_date'          => DateAngajatMutare::make($angajat),
                'angajat_institutie'    => $institutie[0]->institutie_denumire,
                'angajat_functie'       => $angajat->angajat_functie_curenta === null ? null : $angajat->get_functie_curenta->functie_denumire
            ]
        );
    }

    // Preluare date angajat la numire
    public function preluareAngajatNumire($id){
        $angajat = Angajat::find($id);

        return DateAngajatNumire::make($angajat);
    }

    // Mutare angajat la alta institutie
    public function mutareAngajat($id, Request $request){
        // Identificare institutie la care angajatul se va muta
        $institutie = Institutii::find($request->mutare['institutie_id']);

        if(is_object($institutie)){
            $angajat = Angajat::find($id);

            // TODO - identificare stat si pozitie veche
            $id_stat = StatOrganizare::where('so_institutie_id', '=', $angajat->angajat_institutie_curenta)->first()->id;
            // Setare conditii pentur identificare pozitie veche
            $conditii_pozitie_veche = [
                'ps_stat' => $id_stat,
                'ps_angajat' =>$angajat->id
            ];

            // Identificare pozitie veche
            $pozitie_veche = PozitiiOrganizare::where($conditii_pozitie_veche)->first();
            if(!empty($pozitie_veche)){
                $pozitie_veche->ps_angajat = null;
                $pozitie_veche->ps_data_emitere = null;
                $pozitie_veche->ps_data_numire = null;
                $pozitie_veche->ps_numar_act = null;

                $pozitie_veche->save();
            }

            $angajat->angajat_institutie_curenta = $institutie->id;
            $angajat->angajat_functie_curenta = null;
            $angajat->angajat_pozitie_curenta = null;
            $angajat->angajat_cod_acces = $institutie->institutie_cod_acces;

            $angajat->save();

            $mutatie_profesionala = new MutatiiProfesionale();
            // Salvare mutatie profesionala
            $mutatie_profesionala = new MutatiiProfesionale();
            $mutatie_profesionala->mp_act_numar                     = $request->mutare['numar_act_administrativ'];
            $mutatie_profesionala->mp_act_data_emitere              = $request->mutare['data_emitere_act_administrativ'];
            $mutatie_profesionala->mp_act_data_aplicare             = $request->mutare['data_aplicare_act_administrativ'];
            $mutatie_profesionala->mp_institutie_id                 = $request->mutare['institutie_id'];
            $mutatie_profesionala->mp_angajat_id                    = $angajat->id;
            $mutatie_profesionala->mp_cuprins_id                    = null;
            $mutatie_profesionala->mp_fel_numire_id                 = 1;
            $mutatie_profesionala->mp_pozitie_id                    = null;
            $mutatie_profesionala->mp_functie_id                    = null;

            $mutatie_profesionala->save();

            // verificare daca exista salariu generat
            $salariu_generat = Salariu::where([
                ['s_angajat',       '=', $angajat->id],
                ['s_achitat',       '=', 0]
            ])->first();

            if(is_object($salariu_generat)){
                $salariu_generat->s_end_date  = Carbon::now();
                $salariu_generat->save();
            }

            return $angajat;

        }else{
            return response()->json([
                'cod_raspuns'       => 4000,
                'mesaj_raspuns'     => 'Institutia nu exista!'
            ]);
        }
    }

    // Incetare contract angajat
    public function angajatIncetareContract(Request $request){
        // Identificare Angajat
        $id_angajat = $request->date['id_angajat'];
        $angajat    = Angajat::find($id_angajat);

        // Setare status false
        $angajat->angajat_status                = 0;
        $angajat->angajat_functie_curenta       = null;

        // Salvare date
        if($angajat->save()){

            // Actualizare date pozitie stat
            $id_stat = StatOrganizare::where('so_institutie_id', '=', $angajat->angajat_institutie_curenta)->first()->id;
            // Setare conditii pentur identificare pozitie veche
            $conditii_pozitie_veche = [
                'ps_stat' => $id_stat,
                'ps_angajat' =>$angajat->id
            ];

            // Identificare pozitie veche
            $pozitie_veche = PozitiiOrganizare::where($conditii_pozitie_veche)->first();
            if(!empty($pozitie_veche)) {
                $pozitie_veche->ps_angajat = null;
                $pozitie_veche->ps_data_emitere = null;
                $pozitie_veche->ps_data_numire = null;
                $pozitie_veche->ps_numar_act = null;

                $pozitie_veche->save();
            }

            // Creare mutatie profesionala
            $mutatie_profesionala                           = new MutatiiProfesionale();
            $mutatie_profesionala->mp_act_numar             = $request->date['numar_act_administrativ'];
            $mutatie_profesionala->mp_act_data_emitere      = $request->date['data_emitere_act_administrativ'];
            $mutatie_profesionala->mp_act_data_aplicare     = $request->date['data_aplicare_act_administrativ'];
            $mutatie_profesionala->mp_institutie_id         = $angajat->angajat_institutie_curenta;
            $mutatie_profesionala->mp_angajat_id            = $angajat->id;
            $mutatie_profesionala->mp_cuprins_id            = null;
            $mutatie_profesionala->mp_fel_numire_id         = 6;
            $mutatie_profesionala->mp_pozitie_id            = null;
            $mutatie_profesionala->mp_functie_id            = null;

            // Salvare mutatie profesionala
            if($mutatie_profesionala->save()){
                // Incetare contract de munca
                $this::incetareContractByAngajat($angajat, $request->date['data_aplicare_act_administrativ']);

                return response()->json([
                    'cod_raspuns'   => 2000
                ]);
            }
        }
    }

    // Preluare date pentru afisarea calificativelor
    public function preluaredatecalificativ($id){
        $angajat = Angajat::find($id);

        return response()->json([
            'angajat'       => $angajat,
            'calificative'  => DateCalificativeAngajat::collection($angajat->calificative),
            'next_date'     => DB::select(DB::raw("select max(ca_data_sfarsit) as nextdate from angajati_calificative where ca_angajat = '$angajat->id'")->getValue())
        ]);
    }

    // Adaugare calificativ angajat
    public function adaugareCalificativ(Request $request){

        // Identificare angajat
        $angajat = Angajat::find($request->angajat);

        // Identificare institutie curenta
        $institutie = $angajat->angajat_institutie_curenta;

        // verificare daca angajatul mai are evaluare

        $calificativ_existent = Calificativ::where([
                ['ca_angajat',      '=', $angajat->id],
                ['ca_data_sfarsit', '>=', $request->evaluare['dela']],
            ])->orWhere([
                ['ca_angajat',      '=', $angajat->id],
                ['ca_data_inceput', '=', $request->evaluare['dela']],
                ['ca_data_sfarsit', '=', $request->evaluare['panala']],
        ])->first();

        if(is_object($calificativ_existent)){
            return response()->json([
                'cod_raspuns' => 500
            ]);
        }else{
            // Creare obiect nou pentru evaluare
            $calificativ = new Calificativ();
            $calificativ->ca_angajat                = $angajat->id;
            $calificativ->ca_institutie             = $institutie;
            $calificativ->ca_data_inceput           = $request->evaluare['dela'];

            // Verificare de la sa nu fie mai inapoi de data angajarii
            $contract = Contract::where([
                ['c_angajat',           '=', $angajat->id],
                ['c_stare_contract',    '=', 1]
            ])->first();

            // verificare daca are contract activ
            if($calificativ->ca_data_inceput < $contract->c_data_incepere_contract){
                return response()->json([
                    'cod_raspuns' => 501
                ]);
            }else {
                $calificativ->ca_data_sfarsit           = $request->evaluare['panala'];
                $calificativ->ca_calificativ_initial    = $request->evaluare['calificativ'];
                $calificativ->ca_are_contestatie        = false;
                $calificativ->ca_calificativ_final      = $request->evaluare['calificativ'];
                $calificativ->ca_status                 = false;

                if($calificativ->save()){
                    return response()->json([
                        'cod_raspuns' => 1000
                    ]);
                }
            }
        }
    }

    public static function salvareContract($angajat, $tip, $data){
        $contract = new Contract();
        $contract->c_angajat                    = $angajat->id;
        $contract->c_tip_contract               = $tip;
        $contract->c_data_incepere_contract     = $data;
        $contract->c_stare_contract             = 1;
        $contract->save();
    }

    public static function incetareContractByAngajat($angajat, $data){
        $contract = Contract::where([
            ['c_angajat',           '=', $angajat->id],
            ['c_stare_contract',    '=', 1]
        ])->first();

        $contract->c_stare_contract         = 0;
        $contract->c_data_incetare_contract = $data;
        $data_inceput_contract              = Carbon::parse($contract->c_data_incepere_contract);
        $contract->c_zile_contract          = $data_inceput_contract->diff($data)->days;
        $contract->save();
    }

    public function preluareAnPrecedent($an, $institutie){
        $start_date     = Carbon::now()->startOfYear();
        $end_date       = Carbon::now()->endOfYear();

        $calificative   = Calificativ::where([
            ['ca_institutie',   '=', $institutie],
            ['ca_data_inceput', '>=', $start_date],
            ['ca_data_sfarsit', '<=', $end_date],
        ])->get();

        return DateCalificativeAngajat::collection($calificative);
    }

    public function preluareCalificativeFiltrat($institutie, $dela, $panala){
        $calificative = Calificativ::where([
            ['ca_institutie',   '=', $institutie],
            ['ca_data_inceput', '>=', $dela],
            ['ca_data_sfarsit', '<=', $panala]
        ])->get();

        return DateCalificativeAngajat::collection($calificative);
    }
}
