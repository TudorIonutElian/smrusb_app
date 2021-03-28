<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FisaEvidentaAngajat extends JsonResource
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
            'angajat_id'                            => $this->id,
            'angajat_nume'                          => $this->angajat_nume,
            'angajat_prenume_tata'                  => $this->angajat_prenume_tata,
            'angajat_prenume_mama'                  => $this->angajat_prenume_mama,
            'angajat_prenume'                       => $this->angajat_prenume,
            'angajat_cnp'                           => $this->angajat_cnp,
            'angajat_nume_anterior'                 => $this->angajat_nume_anterior,
            'angajat_data_nasterii'                 => $this->angajat_data_nasterii,
            'angajat_stare_civila'                  => $this->angajat_stare_civila,
            'angajat_adresa'                        => $this->adresa,
        ];
    }
}
