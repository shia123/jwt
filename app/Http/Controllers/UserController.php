<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //

    public function register(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'email' => $email,
            'password' =>Hash::make($password)
        ]);

        return $user;
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'user'=>$token
        ]);
    }
}

