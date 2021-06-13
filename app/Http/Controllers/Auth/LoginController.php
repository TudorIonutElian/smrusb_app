<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('user_username', $request->username)->first();

        if($user){
            if($user->user_is_active === 1){
                if (! $user || ! Hash::check($request->password, $user->user_password)) {
                    throw ValidationException::withMessages([
                        'autentificare' => ['Datele de autentificare sunt incorecte.'],
                    ]);
                }
                return $user->createToken($request->device_name)->plainTextToken;
            }else{
                return response()->json([
                    'return_code'   => 2003,
                ]);
            }
        }else{
            return response()->json([
                'return_code' => 2000
            ]);
        }


    }

    public function logout(Request $request){
        if($request->user()){
            $request->user()->tokens()->delete();

            return response()->json([
                'message'   => 'Successfully logged out',
                'status'    => 201
            ]);
        }else{
            return response()->json([
                'message'   => 'Eroare, nu sunteti autentificat!',
                'status'    => 451
            ]);
        }
    }

    public function checkPassword(Request $request){
        // Preluare parola veche a utilizatorului

        $user = User::find($request->user_id);

        if(Hash::check($request->user_password, $user->user_password)){
            $user->user_password = Hash::make($request->user_password_new);
            $user->save();
            return response()->json([
                'return_message' => 1000
            ]);

        }else{
            return response()->json([
                'return_message' => 0000
            ]);
        }
    }

}
