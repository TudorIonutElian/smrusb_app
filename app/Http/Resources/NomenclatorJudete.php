<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NomenclatorJudete extends JsonResource
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
            'judet_id'                => $this->id,
            'judet_denumire'          => $this->denumire,
            'judet_stare'             => $this->stare,
            'judet_data_creare'       => $this->data_creare,
            'judet_numar_localitati'  => count($this->get_numar_localitati)
        ];
    }
}
