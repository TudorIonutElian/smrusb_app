<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstitutiiNomenclatorResource;
use App\Http\Resources\InstitutiiStateSelect;
use App\Models\Institutii;
use Illuminate\Http\Request;

class InstitutiiController extends Controller
{
    public function preluareToateInstitutiile(){
        return Institutii::all();
    }

    public function institutiiMutare(){
        return InstitutiiStateSelect::collection(Institutii::all());
    }

    public function preluareInstitutiiNomenclator(){
        return InstitutiiNomenclatorResource::collection(Institutii::all());
    }

    public function suspenda(Request $request){
        $institutie                                     = Institutii::find($request->institutie_id);
        $institutie->institutie_este_activa             = 0;

        if($institutie->save()){
            return response()->json([
                'message' =>'Institutia a fost suspendata.',
                'status'  => 201
            ]);
        }
    }

    public function activeaza(Request $request){
        $institutie                                     = Institutii::find($request->institutie_id);
        $institutie->institutie_este_activa             = 1;

        if($institutie->save()){
            return response()->json([
                'message' =>'Institutia a fost activata',
                'status'  => 201
            ]);
        }


    }
}
