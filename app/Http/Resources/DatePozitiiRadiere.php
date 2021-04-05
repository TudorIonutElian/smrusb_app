<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatePozitiiRadiere extends JsonResource
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
          'id'                          => $this->id,
          'pozitie_pozitie'             => $this->ps_pozitie,
          'pozitie_cuprins'             => $this->cuprins->sc_denumire,
          'pozitie_data_creare'         => $this->ps_data_creare,
          'pozitie_functie'             => $this->functie->functie_denumire
        ];
    }
}
