<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * user login
     */
    public function login(LoginRequest $request)
    {
        $credentials = ['email' => $request->email , 'password' => $request->password];
        $remember = $credentials['remember'] ?? false;
        if(!Auth::attempt($credentials , $remember)) {
            return response(['message' => 'Email or password is incorrect'] , 422);
        }

        $user = Auth::user();
        if(!$user->is_admin) {
            return response(["message" => "You don\'t have permission to authenticate as admin"],403);
        }

        $token =  $user->createToken('main')->plainTextToken;
        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    /**
     * logout function
     */
    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
    }
}
