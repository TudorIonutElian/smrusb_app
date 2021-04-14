<?php

namespace App\Http\Resources;

use App\Models\Institutii;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class DateAngajatNumire extends JsonResource
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
            'angajat_nume'                      => $this->angajat_nume,
            'angajat_prenume'                   => $this->angajat_prenume,
            'angajat_data_nasterii'             => $this->angajat_data_nasterii,
            'angajat_varsta'                    => Carbon::createFromDate($this->angajat_data_nasterii)->diffInYears(Carbon::now()),
            'angajat_institutie'                => Institutii::where('id', '=', $this->angajat_institutie_curenta)->first()['institutie_denumire'],
            'angajat_institutie_id'             => $this->angajat_institutie_curenta
        ];
    }
}