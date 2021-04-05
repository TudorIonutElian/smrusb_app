<?php

namespace App\Http\Resources;

use App\Models\Institutii;
use App\Models\Judet;
use App\Models\Localitate;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class DatePersonaleAngajat extends JsonResource
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
            'angajat_nume'                              => $this->angajat_nume,
            'angajat_prenume_tata'                      => $this->angajat_prenume_tata,
            'angajat_prenume_mama'                      => $this->angajat_prenume_mama,
            'angajat_prenume'                           => $this->angajat_prenume,
            'angajat_cnp'                               => $this->angajat_cnp,
            'angajat_nume_anterior'                     => $this->angajat_nume_anterior,
            'angajat_data_nasterii'                     => $this->angajat_data_nasterii,
            'angajat_stare_civila'                      => $this->angajat_stare_civila,
            'angajat_judet_nastere'                     => Judet::where('id', '=', $this->angajat_judet_nastere)->first()['denumire'],
            'angajat_localitate_nastere'                => Localitate::where('id', '=', $this->angajat_localitate_nastere)->first()['denumire'],
            'angajat_nivel_acces'                       => Institutii::where('id', '=', $this->angajat_institutie_curenta)->first()['institutie_denumire'],
            'angajat_varsta'                            => Carbon::createFromDate($this->angajat_data_nasterii)->diffInYears(Carbon::now())
        ];
    }
}
