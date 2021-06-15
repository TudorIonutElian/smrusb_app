<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ListaSanctiuniResource extends JsonResource
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
            'id'                => $this->id,
            'denumire'          => $this->dictionar->ds_denumire,
            'data_acordarii'    => $this->s_data_acordarii,
            'data_expirarii'    => $this->s_data_expirarii,
            'status'            => $this::chekIfExpired($this->s_data_expirarii),
            'radiere_in'        => $this::checkRemainingDays($this->s_data_expirarii)
        ];
    }

    private static function chekIfExpired($dataExpirarii){
        if(Carbon::now()->gt($dataExpirarii)){
            return 0;
        }else{
            return 1;
        }
    }

    private static function checkRemainingDays($dataExpirarii){
        $dataExpirariiFinal = new Carbon($dataExpirarii);
        $now                = Carbon::now();

        if($now->gt($dataExpirarii)){
            return 'Radiat oficiu';
        }else{
            return ($dataExpirariiFinal->diff($now)->days) + 1;
        }

    }
}
