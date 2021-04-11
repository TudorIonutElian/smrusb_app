<?php

namespace App\Http\Controllers;

use App\Http\Resources\DateAngajatiUserDashboard;
use App\Http\Resources\DateAngajatMutare;
use App\Http\Resources\DateAngajatNumire;
use App\Http\Resources\DatePersonaleAngajat;
use App\Http\Resources\DateSalariiAngajat;
use App\Http\Resources\FisaEvidentaAngajat;
use App\Http\Resources\MutatiiAngajat;
use App\Models\Angajat;
use App\Models\Institutii;
use App\Models\MutatiiProfesionale;
use App\Models\PozitiiOrganizare;
use App\Models\Salariu;
use App\Models\StatOrganizare;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
                $user = new User();
                $user->user_first_name  = $angajat->angajat_nume;
                $user->user_last_name   = $angajat->angajat_prenume;
                $user->user_email       = strtolower($angajat->angajat_prenume).'.'.'@smrusb.ro';
                $user->user_username    = $angajat->angajat_prenume.'.'.$angajat->angajat_nume;
                $user->user_password    = Hash::make('password');
                $user->remember_token   = Str::random(10);
                $user->user_is_active   = false;
                $user->user_type        = 3;
                $user->user_cod_acces   = $angajat->angajat_cod_acces;
                $user->user_angajat_id  = $angajat->id;

                if($user->save()){
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

    public function fisaEvidenta($id){
        return [
            'date_personale'        => DatePersonaleAngajat::make(Angajat::find($id)),
            'date_mutatii'          => MutatiiAngajat::collection(MutatiiProfesionale::where('mp_angajat_id', '=', $id)->orderBy('id')->get()),
            'date_salarii'          => DateSalariiAngajat::collection(Salariu::where('s_angajat', '=', Angajat::find($id)->id)->get()),
            'adresa'                => Angajat::find($id)->adresa,

        ];
    }

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

    public function preluareAngajatNumire($id){
        $angajat = Angajat::find($id);

        return DateAngajatNumire::make($angajat);
    }

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

            $salariu_generat->s_end_date  = Carbon::now();
            $salariu_generat->save();

            return $angajat;

        }else{
            return response()->json([
                'cod_raspuns'       => 4000,
                'mesaj_raspuns'     => 'Institutia nu exista!'
            ]);
        }
    }
}
