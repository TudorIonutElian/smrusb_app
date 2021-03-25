<?php

namespace App\Http\Controllers;
use App\Models\Institutii;
use App\Models\User;
use App\Models\UserAccessLevel;
use Illuminate\Http\Request;


class UserController extends Controller
{
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
        return $institutii_acces;
    }
}
