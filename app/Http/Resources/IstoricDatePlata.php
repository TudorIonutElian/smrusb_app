<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IstoricDatePlata extends JsonResource
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
            'idp_metoda'            => $this->dp_metoda,
            'idp_banca'             => $this->banca ? $this->banca['db_denumire']: null,
            'idp_iban'              => $this->dp_iban,
            'idp_titular'           => $this->dp_titular,
            'idp_status'            => $this->dp_status,
        ];
    }
}
