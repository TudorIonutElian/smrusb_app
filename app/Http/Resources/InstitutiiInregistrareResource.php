<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutiiInregistrareResource extends JsonResource
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
            'institutie_id'                 => $this->id,
            'institutie_denumire'           => $this->institutie_denumire,
            'institutie_minister'           => $this->showMinister->minister_prescurtare,
            'institutie_cod_acces'          => $this->institutie_cod_acces,
        ];
    }
}
