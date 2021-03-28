<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocalitatiCollection;
use App\Http\Resources\LocalitatiNastereDomiciliu;
use App\Models\Localitate;
use Illuminate\Http\Request;

class LocalitatiController extends Controller
{
    public function index(){
        return LocalitatiCollection::collection(Localitate::all());
    }
    public function adrese(){
        return LocalitatiNastereDomiciliu::collection(Localitate::all()->sortBy('denumire'));
    }
}
