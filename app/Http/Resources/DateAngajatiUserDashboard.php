<?php

namespace App\Http\Resources;

use App\Models\Functii;
use App\Models\Institutii;
use Illuminate\Http\Resources\Json\JsonResource;

class DateAngajatiUserDashboard extends JsonResource
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
            'angajat_id'                            => $this->id,
            'angajat_nume'                          => $this->angajat_nume,
            'angajat_prenume'                       => $this->angajat_prenume,
            'angajat_cnp'                           => $this->angajat_cnp,
            'angajat_institutie'                    => Institutii::where('institutie_cod_acces', '=', $this->angajat_cod_acces)->first()['institutie_denumire'],
            'angajat_functie'                       => $this::returnareFunctie($this->angajat_functie_curenta),
            'angajat_status'                        => $this->angajat_status,
            'angajat_dob'                           => $this->angajat_data_nasterii,
            'angajat_cnp'                           => $this->angajat_cnp
        ];
    }

    private static function returnareFunctie($functie){
        if($functie == null){
            return 'Nenumit';
        }else{
            return Functii::where('id', '=', $functie)->first()['functie_denumire'];
        }
    }
}
