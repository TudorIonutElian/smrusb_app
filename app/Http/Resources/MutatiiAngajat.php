<?php

namespace App\Http\Resources;

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
            'mutatie_cuprins'                           => $this->cuprins,
            'mutatie_fel_mutatie'                       => $this->fel_numire_id,
            'mutatie_pozitie'                           => $this->pozitie,
            'mutatie_functie'                           => Functii::where('id', '=', $this->mp_functie_id)->first()['functie_denumire'] || null,
        ];
    }
}
