<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DateMutatii extends JsonResource
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
            'mutatie_numar_act'                         => $this->mp_act_numar,
            'mutatie_data_emitere'                      => $this->mp_act_data_emitere,
            'mutatie_data_aplicare'                     => $this->mp_act_data_aplicare,
            'mutatie_institutie'                        => $this->institutie->institutie_denumire,

        ];
    }
}
