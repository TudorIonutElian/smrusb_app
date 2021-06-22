<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListaSanctiuniResource;
use App\Models\DictionarSanctiuni;
use App\Models\Sanctiuni;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SanctiuniController extends Controller
{
    public function preluareSanctiuni(){
        return DictionarSanctiuni::all();
    }

    public function preluareSanctiuniAngajat($id){
       return ListaSanctiuniResource::collection(Sanctiuni::where('s_angajat_id', '=', $id)->get());
    }

    public function adaugareSanctiune(Request $request){
        $sanctiune                      = new Sanctiuni();
        $sanctiune->s_angajat_id        = $request->s_angajat_id;
        $sanctiune->s_sanctiune_id      = $request->s_sanctiune_id;
        $sanctiune->s_data_acordarii    = Carbon::now();
        $sanctiune->s_data_expirarii    = Carbon::now()->addMonth(6);

        if($sanctiune->save()){
            return response()->json([
                'return_message' => 1000
            ]);
        }
    }

    public function radiereSanctiune(Request $request){
        $sanctiune                      = Sanctiuni::find($request->id_sanctiune);
        $sanctiune->s_data_expirarii    = Carbon::now();
        $sanctiune->s_status            = 0;

        if($sanctiune->save()){
            return response()->json([
                'return_message' => 1000
            ]);
        }
    }
}
