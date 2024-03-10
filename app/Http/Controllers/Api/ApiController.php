<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class ApiController extends Controller
{
    //Register API (POST, Formdata)
    public function register(Request $request)
    {
        //data validation
        $request->validate([
            "name" => "required",
            "user_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            "user_role" => "required"
        ]);
        //data save
        User::create([
            "name" => $request->name,
            "user_name" => $request->user_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "user_role" => $request->user_role
        ]);
        //response
        return response()->json([
            "status" => true,
            "message" => "New User Create Successfully"
        ]);
    }

    //Login API (POST,Formdata )
    public function login(Request $request)
    {
        //data validation
        $request->validate([

            "user_name" => "required",
            "password" => "required"
        ]);

        //jwtAuth and attempt
        $token = JWTAuth::attempt([
            "user_name" => $request->user_name,
            "password" => $request->password,
        ]);
        //response
        if (!empty($token)) {
            return response()->json([
                "status" => true,
                "message" => "User Logged in successfully",
                "token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid Login details"
        ]);

    }
    //profile API (GET)
    public function profile()
    {
        $userData = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "user" => $userData

        ]);

    }

    //Refresh Token API (GET)
    public function refreshToken()
    {
        $newToken = auth()->refresh();
        return response()->json([
            "status" => true,
            "message" => "New Access token generated",
            "token" => $newToken
        ]);

    }

    //Logout API (GET)
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "status"=> true,
            "message"=>"User logged out successfully"
        ]);

    }

}
