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
     * @OA\Get(
     *     path="/api/categories",
     *     tags={"Categories"},
     *     operationId="categories",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function getAllCategory()
    {
        $notes = Category::all();
        return ResponseHelper::responseSuccessWithData('Successfully retrieve all categories', $notes);
    }

    /**
     * @OA\Get(
     *     path="/api/category/{id}",
     *     tags={"Categories"},
     *     operationId="categoriesById",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function getCategoryById($id)
    {
        $user_id = Auth::user()->id;
        $category = Category::where([
            ['id', $id],
            ['user_id', $user_id]
        ]);
        return ResponseHelper::responseSuccessWithData('Successfully get data category with id', $category);
    }

    /**
     * @OA\Post(
     *     path="/api/category/create",
     *     tags={"Categories"},
     *     operationId="categoriesadd",
     *     @OA\Parameter(
     *          name="user_id",
     *          description="user_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
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
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function createCategory(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
        ]);

        if ($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $category = Category::create([
                'user_id' => Auth::user()->id,
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

    /**
     * @OA\Put(
     *     path="/api/category/update/{id}",
     *     tags={"Categories"},
     *     operationId="categoriesupdate",
     *     @OA\Parameter(
     *          name="name",
     *          description="name",
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
    public function updateCategory(Request $request, $id)
    {
        $validation = Validator::make($request->only('name'), [
            'name' => 'required|string|max:50'
        ]);

        if ($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'slug' =>  Str::slug($request->name),
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

    /**
     * @OA\Delete(
     *     path="/api/category/delete/{id}",
     *     tags={"Categories"},
     *     operationId="categoriesdelete",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return ResponseHelper::responseSuccess('Successfully deleting category');
    }
}
