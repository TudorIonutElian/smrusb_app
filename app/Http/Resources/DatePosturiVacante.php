<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatePosturiVacante extends JsonResource
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
            'post_id'                   => $this->id,
            'post_pozitie'              => $this->ps_pozitie,
            'post_cuprins'              => $this->cuprins->sc_denumire,
            'post_data_creare'          => $this->ps_data_creare,
            'post_functie'              => $this->functie->functie_denumire,
            'post_coeficient'           => (double)$this->functie->functie_coeficient,
            'post_suma'                 => (int)$this->functie->functie_suma
        ];
    }
}
