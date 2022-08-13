<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
               'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' =>['required', 'min:6', 'confirmed']
        ]);

        if($validation->fails()) :
            return response()->json([
                'status' => false,
                'message' => $validation->errors()
            ],404);
        endif;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'You have successfully registered, Please Login!',
          ]);
    }
}
