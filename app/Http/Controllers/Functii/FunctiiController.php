<?php

namespace App\Http\Controllers\Functii;

use App\Http\Controllers\Controller;
use App\Models\Functii;

class FunctiiController extends Controller
{
    public function all(){
        return Functii::orderBy('functie_coeficient')->get();
    }
}
