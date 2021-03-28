<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PozitiiOrganizareDetail extends JsonResource
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
            'pozitie_id'                            => $this->id,
            'pozitie_stat_id'                       => $this->ps_stat,
            'pozitie_numar'                         => $this->ps_pozitie,
            'pozitie_denumire_cuprins'              => $this->ps_denumire_cuprins,
            'pozitie_functie'                       => $this->functie,
            'pozitie_angajat'                       => $this->angajat,
        ];
    }
}
