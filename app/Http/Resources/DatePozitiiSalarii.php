<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatePozitiiSalarii extends JsonResource
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
            'pozitie'       => $this->ps_pozitie,
            'functie'       => $this->functie->functie_denumire,
            'angajat'       => $this->angajat->angajat_nume.' '.$this->angajat->angajat_prenume,
            'status'        => $this->salariu_generat ? $this->salariu_generat : null
        ];
    }
}
