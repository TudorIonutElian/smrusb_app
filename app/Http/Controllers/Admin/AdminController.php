<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Judet;
use App\Models\Regiune;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUsers(Request $request){
        if($request->user()->userType === 1){
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

        if($request->user()->userType === 1){
            return response()->json([
                'users'             => $users,
                'regiuni'           => $regiuni,
                'judete'            => $judete,
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
        if($user->userType === 1){
            return response()->json([
                'error' =>'Nu puteti suspenda administratorul!',
                'status'  => 401
            ]);
        }else{
            $user->isActive = 0;
            $user->save();

            return response()->json([
                'message' =>'Contul a fost dezactivat!',
                'status'  => 401
            ]);
        }
    }

    public function activeazaCont(Request $request){
        $user = User::find($request->contID);
        if($user->userType === 1){
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
                $user->isActive = 1;
                $user->save();
                return response()->json([
                    'message' =>'Contul a fost activat!',
                    'status'  => 202
                ]);
            }
        }

    }
}
