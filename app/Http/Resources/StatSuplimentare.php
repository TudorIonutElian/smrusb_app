<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatSuplimentare extends JsonResource
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
            'stat_id'               =>$this->id,
            'stat_institutie'       =>$this->institutie->institutie_denumire,
            'stat_numar_posturi'    =>$this->so_numar_posturi_aprobate
        ];
    }
}
