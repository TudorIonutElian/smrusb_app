<?php

namespace App\Http\Controllers;

use App\Http\Resources\VizualizarePontajInstitutie;
use App\Models\Angajat;
use App\Models\Institutii;
use App\Models\Pontaj;
use App\Models\PozitiiOrganizare;
use App\Models\StatOrganizare;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use function PHPUnit\Framework\isEmpty;

class PontajController extends Controller
{
    public function creare(Request $request){
        $institutie = Institutii::where('institutie_cod_acces', '=', $request->pontaj['pontaj_institutie_acces'])->first()->id;
        $pontaj_existent = Pontaj::where([
                'pl_institutie'     => $institutie,
                'pl_angajat'        => $request->pontaj['pontaj_angajat_id'],
                'pl_start_date'     => Carbon::now()->startOfMonth()->format('Y-m-d')
        ])->first();

        if(is_object($pontaj_existent)){
            return response()->json([
                'code_message' => 'pontaj_existent'
            ]);
        }else {
            $pontaj = new Pontaj();
            $pontaj->pl_institutie      = $institutie;
            $pontaj->pl_pozitie         = PozitiiOrganizare::find(Angajat::find($request->pontaj['pontaj_angajat_id'])->angajat_pozitie_curenta)->ps_pozitie;
            $pontaj->pl_angajat         = Angajat::find($request->pontaj['pontaj_angajat_id'])->id;
            $pontaj->pl_start_date      = $request->pontaj['pontaj_data_inceput'];
            $pontaj->pl_end_date        = $request->pontaj['pontaj_data_inceput'];
            $pontaj->pl_numar_ore       = (int)$request->pontaj['pontaj_numar_ore'];

            if($pontaj->pl_numar_ore < 165){
                $pontaj->pl_este_aprobat    = true;
            }else{
                $pontaj->pl_este_aprobat    = false;
            }

            $pontaj->save();

            return $pontaj;
        }
    }

    public function preluare($cod){
        return Pontaj::where('pl_angajat', '=', $cod)->get();
    }

    public function preluarePontajInstitutie($institutie_id){
        return VizualizarePontajInstitutie::collection(Pontaj::where('pl_institutie', '=', $institutie_id)->get());
    }
}
