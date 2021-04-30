<?php

namespace App\Http\Controllers\StatOrganizare;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstitutiiStateSelect;
use App\Http\Resources\StatSuplimentare;
use App\Models\Institutii;
use App\Models\StatOrganizare;
use App\Models\User;
use Illuminate\Http\Request;

class StatOrganizareController extends Controller
{
    public function accesStat($id){
        $user = User::find($id);
        $institutii_acces = $user->get_user_acces;

        $lista_acces = [];
        foreach ($institutii_acces as $acces){
            if($acces->ua_status === 1){
                array_push($lista_acces, $acces->ua_level);
            }
        }
        $lista_institutii = Institutii::whereIn('institutie_cod_acces', $lista_acces)->get();

        return InstitutiiStateSelect::collection($lista_institutii);
    }

    public function preluareStat($id){
        $institutie = Institutii::find($id);
        $stat_organizare = $institutie->stat;

        return [
            'institutie' => $institutie->institutie_denumire,
            'stat'       => $stat_organizare
        ];
    }

    public function verificareStat($id){
        $verificare_stat_organizare = StatOrganizare::where('so_institutie_id', '=', $id)->get();
        if($verificare_stat_organizare->isEmpty()){
            return response()->json([
                'return_code' => 402
            ]);
        }else{
            return response()->json([
                'return_code' => 2000,
                'stat'        => StatSuplimentare::collection($verificare_stat_organizare)
            ]);
        }

    }

    public function creareStat(Request $request){
        $stat_nou = new StatOrganizare();
        $stat_nou->so_institutie_id                     = $request->so_institutie_id;
        $stat_nou->so_numar_posturi_aprobate            = (int)$request->stat['so_numar_posturi_aprobate'];

        if($stat_nou->save()){
            return response()->json([
                'code'          => 2000
            ]);
        };
    }
}
