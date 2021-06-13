<?php

namespace App\Http\Controllers;

use App\Models\DictionarSanctiuni;
use Illuminate\Http\Request;

class SanctiuniController extends Controller
{
    public function preluareSanctiuni(){
        return DictionarSanctiuni::orderBy('dr_denumire')->get();
    }
}
