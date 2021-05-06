<?php

namespace App\Http\Controllers;

use App\Http\Resources\Situatii\SituatieIncetariContracte;
use App\Http\Resources\Situatii\SituatiiMutatiiPersonal;
use App\Models\ContractIstoric;
use App\Models\MutatiiProfesionale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SituatiiController extends Controller
{

    public function incetariContracte(){
        return SituatieIncetariContracte::collection(ContractIstoric::all());
    }

    // metoda pentru preluarea filtrata a incetarilor de contracte
    public function incetariContracteFiltrat($institutie, $dela, $panala){
        $incetari = ContractIstoric::whereBetween('ci_data_incetare', [$dela, $panala])->get();
        $incetari_valide = [];

        foreach ($incetari as $incetareValida){
            if($incetareValida->contract->angajat['angajat_institutie_curenta'] == $institutie){
                array_push($incetari_valide, $incetareValida);
            }
        }
        return SituatieIncetariContracte::collection($incetari);
    }

    // metoda pentru preluarea incetarilor de contracte din ziua curenta
    public function incetariAstazi($institutie){
        $data = Carbon::now();
        $incetari = ContractIstoric::where('ci_data_incetare', '=', $data->toDateString())->get();

        $incetari_valide = [];

        foreach ($incetari as $incetareValida){
            if($incetareValida->contract->angajat['angajat_institutie_curenta'] == $institutie){
                array_push($incetari_valide, $incetareValida);
            }
        }

        return SituatieIncetariContracte::collection($incetari);
    }

    public function mutariPersonalFiltrat($institutie, $dela, $panala){
        $mutari_institutie = MutatiiProfesionale::whereBetween('mp_act_data_aplicare', [$dela, $panala])
            ->where([
                ['mp_fel_numire_id', '=', 1],
                ['mp_institutie_id', '=', $institutie]
            ])
            ->orderBy('mp_act_data_aplicare')
            ->get();

        return SituatiiMutatiiPersonal::collection($mutari_institutie);
    }
}
