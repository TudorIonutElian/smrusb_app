<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstitutiiInregistrareResource;
use App\Http\Resources\InstitutiiNomenclatorResource;
use App\Http\Resources\InstitutiiPosturiResource;
use App\Http\Resources\InstitutiiStateSelect;
use App\Models\Institutii;
use App\Models\PozitiiOrganizare;
use App\Models\StatOrganizare;
use Illuminate\Http\Request;

class InstitutiiController extends Controller
{
    public function actualizarePosturi(Request $request){
        $stat                               = StatOrganizare::where('so_institutie_id', '=', $request->id_institutie)->first();
        $stat->so_numar_posturi_aprobate    = $request->numar_posturi;

        if($stat->save()){
            return response()->json(['return_message' => 200]);
        }

    }

    public function preluareInstitutiiPosturiByID($id){
       $institutie          = Institutii::find($id);
       $stat                = StatOrganizare::where('so_institutie_id', '=', $institutie->id)->first();
       $posturi_ocupate     = PozitiiOrganizare::where([
           ['ps_stat',      '=', $stat->id],
           ['ps_angajat',   '!=', null],
       ])->get();


       return response()->json([
           'institutie_denumire'            => $institutie->institutie_denumire,
           'institutie_posturi_aprobate'    => $stat->so_numar_posturi_aprobate,
           'institutie_posturi_ocupate'     => count($posturi_ocupate),
           'institutie_posturi_vacante'     => $stat->so_numar_posturi_aprobate - count($posturi_ocupate),
       ]);
    }
    public function preluareToateInstitutiile(){
        return InstitutiiInregistrareResource::collection(Institutii::orderby('institutie_minister_id')->get());
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

    public function preluareInstitutiiPosturi(){
        return InstitutiiPosturiResource::collection(Institutii::all());
    }
}
