<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NomenclatorRegiuni extends JsonResource
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
            'regiune_id'            => $this->id,
            'regiune_denumire'      => $this->denumire,
            'regiune_stare'         => $this->stare,
            'regiune_data_creare'   => $this->data_creare,
            'regiune_numar_judete'  => count($this->get_numar_judete),
        ];
    }
}
