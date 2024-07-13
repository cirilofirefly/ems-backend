<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   
    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->validated())) {

            $user = User::where('email', $request->email)->firstOrFail();
            $access_token = $user->createToken('access-token')->plainTextToken;

            return response()->json([
                'message'   => 'Successfully logged in.',
                'data'      => [
                    'user'          => $user,
                    'access_token'  => $access_token
                ]
            ], 200);

        }

        return response()->json(['error' => 'Login failed. Invalid credentials.'], 404);
    }
    
}
