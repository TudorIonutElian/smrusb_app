<?php

namespace App\Http\Resources;

use App\Models\Institutii;
use Illuminate\Http\Resources\Json\JsonResource;

class DateAngajatiAprobareConturi extends JsonResource
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
            'user_username'     => $this->user_username,
            'user_nume'         => $this->user_first_name,
            'user_prenume'      => $this->user_last_name,
            'user_status'       => $this->user_is_active,
        ];
    }
}
