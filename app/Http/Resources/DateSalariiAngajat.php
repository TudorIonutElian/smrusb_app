<?php

namespace App\Http\Resources;

use App\Models\Institutii;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DateSalariiAngajat extends JsonResource
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
            'salariu_institutie'            => $this->institutie->institutie_denumire,
            'salariu_start_date'            => $this->s_start_date,
            'salariu_end_date'              => $this->s_end_date,
            'salariu_suma_initiala'         => $this->s_suma_initiala,
            'salariu_bonus'                 => $this->s_bonus,
            'salariu_suma_finala'           => $this->s_suma_finala,
            'salariu_achitat'               => $this->s_achitat,
            'salariu_tip_achitare'          => $this->s_tip_achitare,
            'salariu_moneda'                => 'RON',
            'salariu_chart_data'            => $this::getDenumireLuna($this->s_end_date)
        ];
    }

    public static function getDenumireLuna($object){
        $data = Carbon::create($object);
        $data_luna = $data->month;
        $data_anul = $data->year;

        switch ($data_luna) {
            case 1:
                return 'Ianuarie/'.$data_anul;
            case 2:
                return 'Februarie/'.$data_anul;
            case 3:
                return 'Martie/'.$data_anul;
            case 4:
                return 'Aprilie/'.$data_anul;
            case 5:
                return 'Mai/'.$data_anul;
            case 6:
                return 'Iunie/'.$data_anul;
            case 7:
                return 'Iulie/'.$data_anul;
            case 8:
                return 'August/'.$data_anul;
            case 9:
                return 'Septembrie/'.$data_anul;
            case 10:
                return 'Octombrie/'.$data_anul;
            case 11:
                return 'Noiembire/'.$data_anul;
            case 12:
                return 'Decembrie/'.$data_anul;
        }
    }
}
