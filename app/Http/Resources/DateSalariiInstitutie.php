<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DateSalariiInstitutie extends JsonResource
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
            'salariu_institutie'            => $this->institutie->institutie_denumire,
            'salariu_angajat'               => $this->angajat->angajat_nume. ' '.$this->angajat->angajat_prenume,
            'salariu_functie'               => $this->functie->functie_denumire,
            'salariu_start_date'            => $this->s_start_date,
            'salariu_end_date'              => $this->s_end_date,
            'salariu_suma_initiala'         => $this->s_suma_initiala,
            'salariu_bonus'                 => $this->s_bonus,
            'salariu_suma_finala'           => $this->s_suma_finala,
            'salariu_achitat'               => $this->s_achitat,
            'salariu_tip_achitare'          => $this->s_tip_achitare,
            'salariu_moneda'                => 'RON',
        ];
    }
}
