<?php

namespace App\Http\Controllers;

use App\Http\Resources\Situatii\SituatieIncetariContracte;
use App\Models\ContractIstoric;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SituatiiController extends Controller
{
    public function incetariContracte(){
        return SituatieIncetariContracte::collection(ContractIstoric::all());
    }

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

    public function incetariAstazi(){
        $incetari = ContractIstoric::where('ci_data_incetare', '=', Carbon::now())->get();
        return SituatieIncetariContracte::collection($incetari);
    }
}
