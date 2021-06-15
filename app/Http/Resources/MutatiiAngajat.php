<?php

namespace App\Http\Resources;

use App\Models\Cuprins;
use App\Models\Functii;
use Illuminate\Http\Resources\Json\JsonResource;

class MutatiiAngajat extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'mutatie_id'                                => $this->id,
            'mutatie_act_numar'                         => $this->mp_act_numar,
            'mutatie_act_data_emitere'                  => $this->mp_act_data_emitere,
            'mutatie_act_data_aplicare'                 => $this->mp_act_data_aplicare,
            'mutatie_institutie'                        => $this->institutie->institutie_denumire,
            'mutatie_cuprins'                           => $this::returnareCuprins($this->mp_cuprins_id),
            'mutatie_fel_mutatie'                       => $this->mp_fel_numire_id,
            'mutatie_pozitie'                           => $this::returnarePozitie($this->pozitie),
//            'mutatie_pozitie'                           => 0,
            'mutatie_functie'                           => $this->functie,
        ];
    }

    private function returnareCuprins($cuprins){
        if($cuprins == null){
            return '';
        }else{
            return Cuprins::where('id', '=', $cuprins)->first()['sc_denumire'];
        }
    }

    private function returnarePozitie($pozitie){
        if($pozitie == null){
            return 0;
        }else{
            return $pozitie->ps_pozitie;
        }
    }
}
