<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Authentication"},
     *     operationId="register",
     *     @OA\Parameter(
     *          name="name",
     *          description="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password_confirmation",
     *          description="password_confirmation",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
               'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' =>['required', 'min:6', 'confirmed']
        ]);

        if($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'slug' =>  Str::slug($request->name),
            'password' => Hash::make($request->password)
        ]);
        return ResponseHelper::responseSuccess('You have successfully registered, Please Login!');
    }
}