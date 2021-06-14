<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaSalariiAngajatResource extends JsonResource
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
            'salariu_id'                        => $this->id,
            'salariu_institutie'                => $this->institutie->institutie_denumire,
            'salariu_pozitie'                   => $this::returnarePozitieFormat($this->s_pozitie),
            'salariu_functie'                   => $this->functie->functie_denumire,
            'salariu_suma'                      => $this->s_suma_finala,
            'salariu_dela'                      => $this->s_start_date,
            'salariu_panala'                    => $this->s_end_date,
            'salariu_achitat'                   => $this->s_achitat,
            'salariu_datachitare'               => $this->s_data_achitarii,
            'salariu_taxacass'                  => $this->cass->sc_cass,
            'salariu_valoarecass'               => $this->cass->sc_suma,
            'salariu_achitarecass'              => $this->cass->sc_achitat,
        ];
    }

    public static function returnarePozitieFormat($pozitie){
        if($pozitie < 10){
            return '000'.$pozitie;
        }else if($pozitie > 10 && $pozitie < 100){
            return '00'.$pozitie;
        }else if($pozitie > 100 && $pozitie < 1000){
            return '000'.$pozitie;
        }else{
            return $pozitie;
        }
    }
}
