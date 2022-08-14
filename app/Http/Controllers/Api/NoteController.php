<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function getAll()
    {
        $notes = Note::all();
        return ResponseHelper::responseSuccessWithData('Successfully retrieve all notes', $notes);
    }

    public function getDetail($id)
    {
        $note = Note::find($id);
        return ResponseHelper::responseSuccessWithData('Successfully get data note with id', $note);
    }

    public function createNote(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'title' => 'required|string|max:50',
            'content' => 'required|string',
        ]);
        
        if($validation->fails()) :
            return ResponseHelper::responseValidation($validation->errors());
        endif;

        try {
            $note = Note::create([
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,
                
            ]);
            
            $data = Note::where('id', $note->id)->with(['user', 'category'])->get();

            if($data) :
                return ResponseHelper::responseCreated('Successfully created new note!', $data);
            else :
                return ResponseHelper::responseError('Note not created', 400);
            endif;
            
        } catch (Exception $error) {
            return ResponseHelper::responseError($error->getMessage(), 400);
        }
    }

    public function updateNote(Request $request, $id) 
    {
        $validation = Validator::make($request->only('category_id', 'title', 'content'), [
            'category_id' => 'required|integer',
            'title' => 'required|string|max:50',
            'content' => 'required|string',
        ]);
        
        if($validation->fails()) :
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

            if($note) :
                return ResponseHelper::responseSuccessWithData('Successfully update note', $note);
            else :
                return ResponseHelper::responseError('Note not updated', 400);
            endif;
            
        } catch (Exception $error) {
            return ResponseHelper::responseError($error->getMessage(), 400);
        }
    }

    public function deleteNote($id)
    {
        $note = Note::find($id);
        $note->delete();
        return ResponseHelper::responseSuccess('Successfully deleting note');
    }
}