<?php

namespace App\Http\Controllers;

use App\Http\Resources\IstoricDatePlata;
use App\Models\DatePlata;
use Illuminate\Http\Request;

class DatePlataController extends Controller
{
    public function adaugaDateBancare(Request $request){
        // Verificare daca angajatul are metoda de plata

        $date_plata_verificare = DatePlata::where([
            ['dp_angajat', '=', $request->date['dp_angajat']],
            ['dp_status', '=', 1]
        ])->first();


        if(!is_object($date_plata_verificare)){
            $this->adaugaMetodaDePlataNoua($request);
        }else{
            $date_plata_verificare->dp_status = 0;
            if($date_plata_verificare->save()){
                $this->adaugaMetodaDePlataNoua($request);
            }
        }
    }
    public function preluareDateBancare($angajat_id){
        return IstoricDatePlata::collection(DatePlata::where('dp_angajat', '=', $angajat_id)->get());
    }

    public function adaugaMetodaDePlataNoua($request){
        $date_plata = new DatePlata();
        $date_plata->dp_angajat         = $request->date['dp_angajat'];
        $date_plata->dp_metoda          = (int) $request->date['dp_tip_plata'];
        $date_plata->dp_banca           = $request->date['dp_banca_id'] != 0 ? $request->date['dp_banca_id']: 0;
        $date_plata->dp_iban            = $request->date['dp_cont_iban'];
        $date_plata->dp_moneda          = 'RON';
        $date_plata->dp_titular         = $request->date['dp_titular_cont'];
        $date_plata->dp_status          = true;

        if($date_plata->save()){
            return response()->json([
                'cod_raspuns' => 1000
            ]);
        }else{
            return response()->json([
                'cod_raspuns' => 500
            ]);
        }
    }
}
