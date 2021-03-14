<?php

namespace App\Http\Controllers;

use App\Models\Institutii;
use Illuminate\Http\Request;

class InstitutiiController extends Controller
{
    public function preluareToateInstitutiile(){
        return Institutii::all();
    }
}
