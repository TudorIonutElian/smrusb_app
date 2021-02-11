<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUsers(Request $request){
        if($request->user()->isAdmin === 1){
            return User::all();
        }else{
            return response()->json([
                'error' =>'Nu sunteti administrator!',
                'status'  => 401
            ]);
        }
    }
}
