<?php

namespace App\Http\Resources;

use App\Models\PozitiiOrganizare;
use Illuminate\Http\Resources\Json\JsonResource;

class InstitutiiPosturiResource extends JsonResource
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
            'institutie_stare'                  => $this->institutie_este_activa,
            'institutie_posturi_aprobate'       => $this->stat->so_numar_posturi_aprobate,
            'institutie_posturi_ocupate'        => count($this::returnareNumarPosturiOcupate($this)),
            'institutie_posturi_vacante'        => $this->stat->so_numar_posturi_aprobate - count($this::returnareNumarPosturiOcupate($this))
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

    public static function returnareNumarPosturiOcupate($institutie){
        $stat_id = $institutie->stat->id;
        $pozitii = PozitiiOrganizare::where([
            ['ps_stat',     '=', $stat_id],
            ['ps_angajat',  '!=', null],
        ])->get();

        return $pozitii;

    }
}
