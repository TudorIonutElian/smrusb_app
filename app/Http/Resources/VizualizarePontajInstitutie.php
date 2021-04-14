<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VizualizarePontajInstitutie extends JsonResource
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
            'pontaj_id'                 => $this->id,
            'pontaj_institutie'         => $this->institutie['institutie_denumire'],
            'pontaj_pozitie'            => $this->pl_pozitie,
            'pontaj_angajat'            => $this->angajat['angajat_nume'].' '.$this->angajat['angajat_prenume'],
            'pontaj_dela'               => $this->pl_start_date,
            'pontaj_panala'             => $this->pl_end_date,
            'pontaj_ore'                => $this->pl_numar_ore,
            'pontaj_status'             => $this->pl_este_aprobat,
        ];
    }
}
