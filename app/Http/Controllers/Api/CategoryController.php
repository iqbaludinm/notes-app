<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Str;

class CategoryController extends Controller
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

    public function getAllCategory()
    {
        $notes = Category::all();
        return ResponseHelper::responseSuccessWithData('Successfully retrieve all notes', $notes);
    }

    public function getCategoryById($id)
    {
        $note = Category::find($id);
        return ResponseHelper::responseSuccessWithData('Successfully get data category with id', $note);
    }

    public function createCategory(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'name' => 'required|string|max:50',
        ]);

        if ($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $category = Category::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'slug' =>  Str::slug($request->name),
            ]);

            $data = Category::where('id', $category->id)->with(['user'])->get();

            if ($data) :
                return ResponseHelper::responseCreated('Successfully created new category!', $data);
            else :
                return ResponseHelper::responseError('Category not created', 400);
            endif;
        } catch (Exception $error) {
            return ResponseHelper::responseError($error->getMessage(), 400);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $validation = Validator::make($request->only('user_id', 'name'), [
            'user_id' => 'required|integer',
            'name' => 'required|string|max:50'
        ]);

        if ($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $category = Category::findOrFail($id);
            $category->update([
                'user_id' => $request->user_id,
                'name' => $request->title
            ]);
            $category->save();

            if ($category) :
                return ResponseHelper::responseSuccessWithData('Successfully update category', $category);
            else :
                return ResponseHelper::responseError('Category not updated', 400);
            endif;
        } catch (Exception $error) {
            return ResponseHelper::responseError($error->getMessage(), 400);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return ResponseHelper::responseSuccess('Successfully deleting category');
    }
}
