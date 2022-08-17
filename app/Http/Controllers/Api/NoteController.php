<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends Controller
{
    // protected $user;
    // public function __construct()
    // {
    //     $this->user = JWTAuth::parseToken()->authenticate();
    // }


    /**
     * @OA\Get(
     *     path="/api/notes",
     *     tags={"Notes"},
     *     operationId="notes",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    
    public function getAll(Request $request)
    {
        $note_query = Note::with(['user', 'category']);

        if ($request->search) {
            $note_query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->sort_by && in_array(
            $request->sort_by,
            ['title', 'updated_at']
        )) {
            $sort_by = $request->sort_by;
        } else {
            $sort_by = 'id';
        }

        if ($request->sort_order && in_array(
            $request->sort_order,
            ['asc', 'desc']
        )) {
            $sort_order = $request->sort_order;
        } else {
            $sort_order = 'asc';
        }

        $notes = $note_query->orderBy($sort_by, $sort_order)->get();

        return ResponseHelper::responseSuccessWithData('Successfully retrieve all notes', $notes);
    }

    /**
     * @OA\Get(
     *     path="/api/note/{id}",
     *     tags={"Notes"},
     *     operationId="notedetails",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */
    public function getDetail($id)
    {
        $user_id = Auth::user()->id;
        $note = Note::where([
            ['id', $id],
            ['user_id', $user_id]
        ]);
        return ResponseHelper::responseSuccessWithData('Successfully get data note with id', $note);
    }

    /**
     * @OA\Post(
     *     path="/api/note/create",
     *     tags={"Notes"},
     *     operationId="noteadd",
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
     *          name="category_id ",
     *          description="category_id ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="title",
     *          description="title",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="content",
     *          description="content",
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
    public function createNote(Request $request)
    {
        $validation = Validator::make($request->only('category_id', 'title', 'content'), [
            'category_id' => 'required|integer',
            'title' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        if ($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $note = Note::create([
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,

            ]);

            $data = Note::where('id', $note->id)->with(['user', 'category'])->get();

            if ($data) :
                return ResponseHelper::responseCreated('Successfully created new note!', $data);
            else :
                return ResponseHelper::responseError('Note not created', 400);
            endif;
        } catch (Exception $error) {
            return ResponseHelper::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/update/{id}?_method=patch",
     *     tags={"Notes"},
     *     operationId="noteupdate",
     *     @OA\Parameter(
     *          name="category_id ",
     *          description="category_id ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="title",
     *          description="title",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="content",
     *          description="content",
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
    public function updateNote(Request $request, $id)
    {
        $validation = Validator::make($request->only('category_id', 'title', 'content'), [
            'category_id' => 'required|integer',
            'title' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        if ($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $note = Note::findOrFail($id);
            $note->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,
            ]);
            $note->save();

            if ($note) :
                return ResponseHelper::responseSuccessWithData('Successfully update note', $note);
            else :
                return ResponseHelper::responseError('Note not updated', 400);
            endif;
        } catch (Exception $error) {
            return ResponseHelper::responseError($error->getMessage(), 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/delete/{id}",
     *     tags={"Notes"},
     *     operationId="notedelete",
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     */

    public function deleteNote($id)
    {
        $note = Note::where([
            'id' => $id,
            'user_id' => Auth::user()->id
        ]);
        $note->delete();
        return ResponseHelper::responseSuccess('Successfully deleting note');
    }


}