<?php

namespace App\Http\Controllers\Cuprins;

use App\Http\Controllers\Controller;
use App\Models\Cuprins;
use App\Models\Institutii;
use App\Models\Regiune;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class CuprinsController extends Controller
{
    public function preluare($institutie){
        $cuprins = Cuprins::where('sc_institutie', '=', $institutie)->orderBy('sc_ordine')->get();
        return $cuprins;
    }
}
