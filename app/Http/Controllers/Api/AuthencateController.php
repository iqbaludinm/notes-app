<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthencateController extends Controller
{
        /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Authentication"},
     *     operationId="login",
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
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

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

       /**
     * @OA\Post(
     *     path="/logout",
     *     tags={"Authentication"},
     *     operationId="logout",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'message' => 'Log out successfully!',
          ]);
    }
}
