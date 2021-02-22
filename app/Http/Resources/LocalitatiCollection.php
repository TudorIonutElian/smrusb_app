<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocalitatiCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id_localitate'                         => $this->id,
            'denumire_localitate'                   => $this->denumire,
            'judet_localitate_id'                   => $this->getJudet->id,
            'judet_localitate_denumire'             => $this->getJudet->denumire,
            'mediu_urban'                           => $this->urban,
            'localitate_resedinta_judet'            => $this->resedinta,
            'stare_localitate'                      => $this->stare,
        ];
    }
}
