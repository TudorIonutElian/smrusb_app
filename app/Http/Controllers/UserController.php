<?php

namespace App\Http\Controllers;
use App\Http\Resources\DateAngajatiAprobareConturi;
use App\Http\Resources\ListaSalariiAngajatResource;
use App\Models\Institutii;
use App\Models\Salariu;
use App\Models\User;
use App\Models\UserAccessLevel;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function preluareListaSalariiAngajat($id){
        return ListaSalariiAngajatResource::collection(Salariu::where('s_angajat', '=', $id)->get());
    }

    public function pannel($id){
        $user           = User::find($id);
        $user_acces     = $user->get_user_acces;
        $user_history   = $user->get_istoric_user;

        return response()->json([
            'user_data'             => $user,
            'user_acces'            => $user_acces,
            'user_history'          => $user_history,
        ]);
    }

    public function acces($id){
        $acces = UserAccessLevel::where('ua_user', '=', $id)->get();
        return $acces;
    }

    // Functie pentru adaugarea accesului

    public function adaugaAcces($id, Request $request){
        $user_id = User::find($id)->id;
        $institutie = Institutii::where('institutie_cod_acces', '=', $request->user_acces_solicitat)->first();

        $user_acces_creare = new UserAccessLevel();
        $user_acces_creare->ua_user         = $user_id;
        $user_acces_creare->ua_level        = $request->user_acces_solicitat;
        $user_acces_creare->ua_denumire     = $institutie->institutie_denumire;
        $user_acces_creare->ua_status       = false;

        // Verificare daca userul mai are acces la institutia respectiva

        $verificare_acces = UserAccessLevel::where([
            ['ua_user', '=', $user_id],
            ['ua_level', '=', $request->user_acces_solicitat]
        ])->get();

        if(!$verificare_acces->isEmpty()){
            return response()->json([
               'return_code' => 2003
            ]);
        }else{
            $user_acces_creare->save();
        }


    }

    public function accesInstitutii($id){
        $user = User::find($id);
        $institutii_acces = $user->get_user_acces;

        $lista_acces = [];

        foreach ($institutii_acces as $acces){
            if($acces->ua_status === 1){
                array_push($lista_acces, Institutii::select('id', 'institutie_denumire')->where('institutie_cod_acces', '=', $acces->ua_level)->first());
            }
        }
        return $lista_acces;
    }

    public function aprobareConturiAngajat($user_id){

        return DateAngajatiAprobareConturi::collection(User::where([
            ['user_added_by',   '=', $user_id],
            ['user_is_active',  '=', 0]
        ])->get());
    }

    public function aprobareContRUAngajat($angajat_id){
        $user = User::find($angajat_id);
        $user->user_is_active = 1;
        $user->save();

        return response()->json([
            'cod_raspuns'   => 2000
        ]);

    }
}
