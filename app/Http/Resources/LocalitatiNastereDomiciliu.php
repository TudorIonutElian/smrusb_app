<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocalitatiNastereDomiciliu extends JsonResource
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
            'localitate_id'                  => $this->id,
            'localitate_denumire'           => $this->denumire,
            'localitate_judet_id'           => $this->judet
        ];
    }
}
