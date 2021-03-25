<?php

namespace App\Http\Controllers;

use App\Models\Judet;
use App\Models\Localitate;
use App\Models\Regiune;
use Illuminate\Http\Request;

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
}
