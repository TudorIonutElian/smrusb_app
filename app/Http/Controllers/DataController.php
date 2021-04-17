<?php

namespace App\Http\Controllers;

use App\Models\Judet;
use App\Models\Localitate;
use App\Models\MotivIncetareContract;
use App\Models\Regiune;

class DataController extends Controller
{
    public function index(){
        $regiuni        = Regiune::all();
        $judete         = Judet::all();
        $localitati     = Localitate::all();

        return response()->json([
            'regiuni'           => $regiuni,
            'judete'            => $judete,
            'localitati'        => $localitati
        ]);
    }
    public function preluareMotiveIncetareContract(){
        return MotivIncetareContract::all();
    }
}
