<?php

namespace App\Http\Controllers\Cuprins;

use App\Http\Controllers\Controller;
use App\Models\Cuprins;
use Illuminate\Http\Request;

class CuprinsController extends Controller
{
    public function preluare($institutie){
        $cuprins = Cuprins::where('sc_institutie', '=', $institutie)->orderBy('sc_ordine')->get();
        return $cuprins;
    }

    public function creare(Request $request){
        $cuprins_nou = new Cuprins();
        $cuprins_nou->sc_institutie = $request->institutie;
        $cuprins_nou->sc_denumire   = $request->cuprins['cn_denumire'];
        $cuprins_nou->sc_ordine     = (int) $request->cuprins['cn_ordine'];

        if($cuprins_nou->save()){
            return response()->json([
                'cod_raspuns'       => 2000,
                'mesaj_raspuns'     => 'Cuprins creat.'
            ]);
        }else{
            return response()->json([
                'cod_raspuns'       => 4000,
                'mesaj_raspuns'     => 'Eroare.'
            ]);
        }

    }
}
