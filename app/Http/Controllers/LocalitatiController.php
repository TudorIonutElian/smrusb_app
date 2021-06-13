<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocalitatiAdminResource;
use App\Http\Resources\LocalitatiCollection;
use App\Http\Resources\LocalitatiNastereDomiciliu;
use App\Models\Localitate;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\Local;

class LocalitatiController extends Controller
{
    public function index(){
        return LocalitatiCollection::collection(Localitate::all());
    }
    public function adrese(){
        return LocalitatiNastereDomiciliu::collection(Localitate::all()->sortBy('denumire'));
    }

    public function preluareLocalitatiByID($judet_id){
        return Localitate::where('judet', '=', $judet_id)->orderBy('denumire')->get();
    }

    public function preluareToateLocalitatile(){
        return LocalitatiAdminResource::collection(Localitate::all());
    }
    public function suspenda(Request $request){
        $localitate            = Localitate::find($request->localitate_id);
        $localitate->stare          = 0;

        if($localitate->save()){
            return response()->json([
                'message' =>'Localitatea a fost suspendata.',
                'status'  => 201
            ]);
        }
    }

    public function activeaza(Request $request){
        $localitate            = Localitate::find($request->localitate_id);
        $localitate->stare     = 1;

        if($localitate->save()){
            return response()->json([
                'message' =>'Localitatea a fost activata',
                'status'  => 201
            ]);
        }


    }
}
