<?php

namespace App\Http\Controllers;

use App\Http\Resources\NomenclatorRegiuni;
use App\Models\Regiune;
use Illuminate\Http\Request;

class RegiuniController extends Controller
{
    public function index(){
        return NomenclatorRegiuni::collection(Regiune::all());
    }

    public function suspenda(Request $request){
        $regiune            = Regiune::find($request->regiune_id);
        $regiune->stare     = 0;

        if($regiune->save()){
            return response()->json([
                'message' =>'Regiunea a fost suspendata',
                'status'  => 201
            ]);
        }
    }

    public function activeaza(Request $request){
        $regiune            = Regiune::find($request->regiune_id);
        $regiune->stare     = 1;

        if($regiune->save()){
            return response()->json([
                'message' =>'Regiunea a fost activata',
                'status'  => 201
            ]);
        }


    }
}
