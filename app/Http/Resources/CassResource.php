<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CassResource extends JsonResource
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
            'cass_id'                           => $this->id,
            'cass_institutie'                   => $this->institutie->institutie_denumire,
            'cass_angajat'                      => $this->angajat->angajat_nume . ' ' . $this->angajat->angajat_prenume,
            'cass_salariu'                      => $this->salariu->s_suma_finala,
            'cass_suma'                         => $this->sc_suma,
            'cass_start_date'                   => $this->sc_start_date,
            'cass_end_date'                     => $this->sc_end_date,
        ];
    }
}
