<?php

namespace App\Http\Resources;

use App\Models\Functii;
use App\Models\Institutii;
use Illuminate\Http\Resources\Json\JsonResource;

class DateAngajatiUserDashboard extends JsonResource
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
            'angajat_id'                            => $this->id,
            'angajat_nume'                          => $this->angajat_nume,
            'angajat_prenume'                       => $this->angajat_prenume,
            'angajat_cnp'                           => $this->angajat_cnp,
            'angajat_institutie'                    => Institutii::where('institutie_cod_acces', '=', $this->angajat_cod_acces)->first()['institutie_denumire'],
            'angajat_functie'                       => Functii::where('id', '=', $this->angajat_functie_curenta)->first()['functie_denumire'],
        ];
    }
}
