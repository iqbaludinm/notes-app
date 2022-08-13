<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthencateController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status' => true,
                'message' => 'Congratulations, you have successfully logged in!',
                'Data' => Auth::user()
            ]);
        }
        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorect.']
        ]);

    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'Log out successfully!',
          ]);
    }
}
