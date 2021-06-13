<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecompenseResource extends JsonResource
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
            'id'                => $this->id,
            'denumire'          => $this->dictionar->dr_denumire,
            'data_acordarii'    => $this->r_data_acordarii,
            'data_expirarii'    => $this->r_data_expirarii,
        ];
    }
}
