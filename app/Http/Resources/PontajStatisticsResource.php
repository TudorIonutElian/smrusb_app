<?php

namespace App\Http\Resources;

use App\Models\Pontaj;
use Illuminate\Http\Resources\Json\JsonResource;

class PontajStatisticsResource extends JsonResource
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
            'id'                        => $this->id,
            'pl_angajat'                => $this->pl_angajat,
            'pl_end_date'               => $this->pl_end_date,
            'pl_este_aprobat'           => $this->pl_este_aprobat,
            'pl_institutie'             => $this->institutie->institutie_denumire,
            'pl_numar_ore'              => $this->pl_numar_ore,
            'pl_pozitie'                => $this->pl_pozitie,
            'pl_start_date'             => $this->pl_start_date,
            'pl_diferenta'              => number_format((float)(($this->pl_numar_ore / $this::getMediePontaje($this)) *100), 2, '.', '')
        ];
    }

    public static function getMediePontaje($pontaj){
        return Pontaj::where([
            ['pl_start_date',   '=', $pontaj->pl_start_date],
            ['pl_end_date',     '=', $pontaj->pl_end_date],
        ])->avg('pl_numar_ore');
    }
}
