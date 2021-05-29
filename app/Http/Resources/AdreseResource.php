<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdreseResource extends JsonResource
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
            'id'                    => $this->id,
            'aa_judet'              => $this->judet->denumire,
            'aa_localitate'         => $this->localitate->denumire,
            'aa_strada'             => $this->aa_strada,
            'aa_numar'              => $this->aa_numar,
            'aa_bloc'               => $this->aa_bloc,
            'aa_scara'              => $this->aa_scara,
            'aa_etaj'               => $this->aa_etaj,
            'aa_apartament'         => $this->aa_apartament,
            'aa_telefon_fix'        => $this->aa_telefon_fix,
            'aa_telefon_mobil'      => $this->aa_telefon_mobil,
            'aa_status'             => $this->aa_status,
        ];
    }
}
