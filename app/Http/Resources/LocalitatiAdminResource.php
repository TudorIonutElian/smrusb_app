<?php

namespace App\Http\Resources;

use App\Models\Judet;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalitatiAdminResource extends JsonResource
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
            'localitate_id'                         => $this->id,
            'localitate_denumire'                   => $this->denumire,
            'localitate_mediul'                     => $this->urban,
            'localitate_resedinta'                  => $this->resedinta,
            'localitate_stare'                      => $this->stare,
        ];
    }

}
