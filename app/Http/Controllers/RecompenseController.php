<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecompenseResource;
use App\Models\DictionarRecompense;
use App\Models\Recompense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecompenseController extends Controller
{
    public function preluareRecompense(){
        return DictionarRecompense::orderBy('dr_denumire')->get();
    }

    public function preluareRecompenseAngajat($angajat){
        return RecompenseResource::collection(Recompense::where('r_angajat_id', '=', $angajat)->get());
    }

    public function adaugareRecompensa(Request $request){
        $recompensa                     = new Recompense();
        $recompensa->r_angajat_id       = $request->id_angajat;
        $recompensa->r_recompensa_id    = $request->id_recompensa;
        $recompensa->r_data_acordarii   = Carbon::now();
        $recompensa->r_data_expirarii   = Carbon::now()->addMonth(6);

        if($recompensa->save()){
            return response()->json([
                'return_message' => 1000
            ]);
        }
    }
}
