<?php

namespace App\Http\Controllers;

use App\Models\Recompense;
use Illuminate\Http\Request;

class RecompenseController extends Controller
{
    public function preluare(){
        return Recompense::all();
    }
}
