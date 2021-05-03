<?php

namespace App\Http\Resources\Situatii;

use App\Models\Institutii;
use App\Models\MotivIncetareContract;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SituatieIncetariContracte extends JsonResource
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
          'sic_id'              => $this->id,
          'sic_numar_contract'  => $this->contract->id.'/'.Carbon::make($this->contract->c_data_incepere_contract)->year,
          'sic_angajat'         => $this->contract->angajat['angajat_nume'].' '. $this->contract->angajat['angajat_prenume'],
          'sic_institutie'      => Institutii::find($this->contract->angajat['angajat_institutie_curenta'])->institutie_denumire,
          'sic_data_incepere'   => $this->ci_data_incepere,
          'sic_data_incetare'   => $this->ci_data_incetare,
          'sic_motiv_incetare'  => MotivIncetareContract::find($this->ci_motiv_incetare)->mic_denumire,
          'sic_sumar_incetare'  => $this->ci_sumar,
          'sic_numar_zile'      => $this->contract['c_zile_contract'],
        ];
    }
}
