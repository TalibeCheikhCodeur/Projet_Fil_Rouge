<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    public function login(Request $request)
    {

        if (!Auth::attempt($request->only("login", "password"))) {
            return response([
                "message" => "Invalid credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken("token")->plainTextToken;
        $cookie = cookie("token", $token, 24 * 60);

        return response([
            "token" => $token
        ])->withCookie($cookie);
    }

    public function logout()
    {

        Auth::logout();
        Cookie::forget("token");

        return response()->json(['message' => "deconnection avec succes"]);
    }
}
