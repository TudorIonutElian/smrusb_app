<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutiiNomenclatorResource extends JsonResource
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
            'institutie_id'                     => $this->id,
            'institutie_minister'               => $this->showMinister->minister_denumire,
            'institutie_denumire'               => $this->institutie_denumire,
            'institutie_ordonator_id'           => $this::returnareNumeOrdonator($this->institutieSuperioara),
            'institutie_cod_acces'              => $this->institutie_cod_acces,
            'institutie_numar_angajati'         => count($this->angajati),
            'institutie_stare'                  => $this->institutie_este_activa,
        ];
    }

    public static function returnareNumeOrdonator($institutieSuperioara){
        if($institutieSuperioara != null){
            return $institutieSuperioara->institutie_denumire;
        }
        else{
            return 'Nu are';
        }
    }
}
