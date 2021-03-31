<?php

namespace App\Http\Controllers;

use App\Http\Resources\FisaEvidentaAngajat;
use App\Http\Resources\MutatiiAngajat;
use App\Models\Angajat;
use App\Models\MutatiiProfesionale;
use App\Models\User;
use Illuminate\Http\Request;

class AngajatiController extends Controller
{
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
            $angajat->angajat_cod_acces                                 = $request->angajat['acces_level'];
            $angajat->angajat_judet_nastere                             = $request->angajat['judet_nastere'];
            $angajat->angajat_localitate_nastere                        = $request->angajat['localitate_nastere'];

            if($angajat->save()){
                return response()->json([
                    'cod'     => '001',
                    'status'       => 200
                ]);
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
        return $angajati;
    }

    public function fisaEvidenta($id){
        return [
            'date_personale'        => Angajat::find($id),
            'date_mutatii'          => MutatiiAngajat::collection(MutatiiProfesionale::where('mp_angajat_id', '=', $id)->get()),
            'adresa'                => Angajat::find($id)->adresa,

        ];
    }
}
