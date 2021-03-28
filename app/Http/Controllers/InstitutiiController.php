<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstitutiiStateSelect;
use App\Models\Institutii;
use Illuminate\Http\Request;

class InstitutiiController extends Controller
{
    public function preluareToateInstitutiile(){
        return Institutii::all();
    }

    public function institutiiMutare(){
        return InstitutiiStateSelect::collection(Institutii::all());
    }
}
