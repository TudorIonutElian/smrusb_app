<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocalitatiCollection;
use App\Models\Institutii;
use App\Models\Judet;
use App\Models\Localitate;
use App\Models\Regiune;
use App\Models\User;
use App\Models\UserAccessLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showUsers(Request $request){
        if($request->user()->user_type === 1){
            return User::all();
        }else{
            return response()->json([
                'error' =>'Nu sunteti administrator!',
                'status'  => 401
            ]);
        }
    }

    public function loadData(Request $request){
        $users                      = User::all();
        $regiuni                    = Regiune::withCount('judete')->get();
        $judete                     = Judet::with('regiuni')->get();
        $localitati                 = Localitate::all();

        if($request->user()->user_type === 1){
            return response()->json([
                'users'             => $users,
                'regiuni'           => $regiuni,
                'judete'            => $judete,
                'localitati'        => LocalitatiCollection::collection(Localitate::all()),
                'status'            => 200
            ]);
        }else{
            return response()->json([
                'error' =>'Nu sunteti administrator!',
                'status'  => 401
            ]);
        }
    }

    public function suspendaCont(Request $request){
        $user = User::find($request->contID);
        if($user->user_type === 1){
            return response()->json([
                'error' =>'Nu puteti suspenda administratorul!',
                'status'  => 401
            ]);
        }else{
            $user->user_is_active = 0;
            $user->save();

            return response()->json([
                'message' =>'Contul a fost dezactivat!',
                'status'  => 401
            ]);
        }
    }

    public function activeazaCont(Request $request){
        $user = User::find($request->contID);
        if($user->user_type === 1){
            return response()->json([
                'error' =>'Nu puteti suspenda administratorul!',
                'status'  => 401
            ]);
        }else{
            if($user->isActive === 1){
                return response()->json([
                    'message' =>'Contul este deja activ!',
                    'status'  => 201
                ]);
            }else{
                $user->user_is_active = 1;
                $user->save();
                return response()->json([
                    'message' =>'Contul a fost activat!',
                    'status'  => 202
                ]);
            }
        }
    }

    public function showInactiveUsers(){
        return User::where('user_is_active', '=', 0)->get();
    }

    public function inregistrareCont(Request $request){
        // Aici creez user
        $user = new User();
        $user->user_first_name        = $request->user_first_name;
        $user->user_last_name         = $request->user_last_name;
        $user->user_email             = $request->user_email;
        $user->user_username          = $request->user_username;
        $user->user_password          = Hash::make($request->user_password);
        $user->remember_token         = Str::random(10);

        if($user->save()){
            $userAcces = new UserAccessLevel();
            $userAcces->ua_user     = $user->id;
            $userAcces->ua_level    = $request->user_acces_level;
            $userAcces->ua_denumire = Institutii::find($request->user_acces_level)->institutie_denumire;

            if($userAcces->save()){
                return response()->json([
                    'mesaj' =>'Utilizator creat!',
                    'status'  => 200
                ]);
            }
        }
    }
}
