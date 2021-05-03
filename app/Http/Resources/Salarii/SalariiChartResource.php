<?php

namespace App\Http\Resources\Salarii;

use Illuminate\Http\Resources\Json\JsonResource;

class SalariiChartResource extends JsonResource
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
            'salariu_luna'    => $this->getDenumireLuna($this),
            'salariu_suma'    => $this->salariu_suma_finala
        ];
    }

    public function getDenumireLuna($object){
        $data = $object->month;
        return $data;
    }
}
