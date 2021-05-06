<?php

namespace App\Http\Resources\Situatii;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SituatiiMutatiiPersonal extends JsonResource
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
            'smp_id'                => $this->id,
            'smp_contract'          => $this->angajat->contract->id.'/'.Carbon::make($this->angajat->contract->c_data_incepere_contract)->year,
            'smp_institutie'        => $this->institutie->institutie_denumire,
            'smp_angajat'           => $this->angajat->angajat_nume.' '.$this->angajat->angajat_prenume,
            'smp_data_angajarii'    => $this->angajat->contract->c_data_incepere_contract,
            'smp_data_aplicare'     => $this->mp_act_data_aplicare,
            'smp_numar_act'         => $this->mp_act_numar,
        ];
    }
}
