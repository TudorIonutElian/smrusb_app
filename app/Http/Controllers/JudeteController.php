<?php

namespace App\Http\Controllers;

use App\Http\Resources\NomenclatorJudete;
use App\Models\Judet;
use Illuminate\Http\Request;

class JudeteController extends Controller
{
    public function index(){
        return NomenclatorJudete::collection(Judet::all()->sortBy('denumire'));
    }

    public function suspenda(Request $request){
        $judet            = Judet::find($request->judet_id);
        $judet->stare     = 0;

        if($judet->save()){
            return response()->json([
                'message' =>'Judetul a fost suspendat.',
                'status'  => 201
            ]);
        }
    }

    public function activeaza(Request $request){
        $judet            = Judet::find($request->judet_id);
        $judet->stare     = 1;

        if($judet->save()){
            return response()->json([
                'message' =>'Judetul a fost activat',
                'status'  => 201
            ]);
        }


    }
}
