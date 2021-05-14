<?php

namespace App\Http\Resources;

use App\Models\Calificativ;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DateCalificativeAngajat extends JsonResource
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
            'ca_id'                     => $this->id,
            'ca_institutie'             => $this->institutie['institutie_denumire'],
            'ca_data_inceput'           => $this->ca_data_inceput,
            'ca_data_sfarsit'           => $this->ca_data_sfarsit,
            'ca_calificativ_initial'    => Calificativ::getDenumireCalificativ($this->ca_calificativ_initial),
            'ca_are_contestatie'        => $this->ca_are_contestatie,
            'ca_calificativ_final'      => Calificativ::getDenumireCalificativ($this->ca_calificativ_final),
            'ca_status'                 => Calificativ::getStatusCalificativ($this->ca_status),
            'ca_angajat_nume'           => $this->angajat['angajat_nume'],
            'ca_angajat_prenume'        => $this->angajat['angajat_prenume'],
            'ca_angajat_dataangajarii'  => $this->angajat->contract['c_data_incepere_contract'],
            'ca_angajat_vechimemunca'   => Carbon::createFromDate($this->angajat->contract['c_data_incepere_contract'])->diffInDays(Carbon::now()),
            'ca_poate_fi_contestat'     => Carbon::createFromDate($this->ca_data_adaugarii)->diffInDays(Carbon::now()) <= 5,
            'ca_data_adaugarii'         => $this->ca_data_adaugarii,
        ];
    }
}
