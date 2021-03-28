<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAccesLevelInactive extends JsonResource
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
            'solicitare_id'             =>$this->id,
            'solicitare_user'           =>$this->get_user->user_email,
            'solicitare_institutie'     =>$this->ua_denumire,
            'solicitare_data'           =>$this->ua_start_date
        ];
    }
}
