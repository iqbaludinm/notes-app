<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
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
        //Validate data
        $data = $request->only('name', 'email', 'password','password_confirmation');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50|confirmed'
        ]);

        // Respon Gagal jikam request tidak valid
        if ($validator->fails()) {
            return ResponseHelper::responseValidation($validator->errors(), 200);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'slug' =>  Str::slug($request->name),
            'password' => Hash::make($request->password)
        ]);
        return ResponseHelper::responseSuccess('You have successfully registered, Please Login!');
    }


    /**
     * @OA\Post(
     *     path="/api/user/upload/photo/{id}",
     *     tags={"Authentication"},
     *     operationId="upload",
     *     @OA\Parameter(
     *          name="photo",
     *          description="photo",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function upload($id,Request $request)
    {
            $user = User::find($id);
            $imageName = time().'.'.$request->photo->extension();

            $path = public_path('images');

            if(!empty($user->photo) && file_exists($path.'/'.$user->photo)) :
                unlink($path.'/'.$user->photo);
            endif;

            $user->photo = $imageName;
            $user->save();

            $request->photo->move(public_path('images'), $imageName);
            return response()->json([
                'status' => true,
                'message' => 'Uploaded Successfully!',
            ]);
    }

    /**
     * @OA\Put(
     *     path="/api/user/update/{id}",
     *     tags={"Authentication"},
     *     operationId="userupdate",
     *     @OA\Parameter(
     *          name="email",
     *          description="email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="name",
     *          description="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *  @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        //Validate data
        $data = $request->only('name','email');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseValidation($validator->errors(), 200);
        }
        User::where('id',$id)->update(
            [
                'email' => $request->email,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            return ResponseHelper::responseSuccess('Data successfully updated');
    }

    public function resetpassword(Request $request)
    {
        //
    }


}
