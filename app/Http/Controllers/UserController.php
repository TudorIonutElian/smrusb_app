<?php

namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    public function pannel($id){
        $user           = User::find($id);
        $user_acces     = $user->get_user_acces;
        $user_history   = $user->get_istoric_user;

        return response()->json([
            'user_data'             => $user,
            'user_acces'            => $user_acces,
            'user_history'          => $user_history,
        ]);
    }
}
