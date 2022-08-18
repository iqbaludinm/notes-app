<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user_all = User::all()->count();
        $note_all = Note::all()->count();
        $category_all = Category::all()->count();

        $users = User::orderBy('id','desc')->paginate(4);
        if(Auth::user()->hasRole('admin')){

            return view('dashboard',[
                'users' => $users,
                'user_all' => $user_all,
                'note_all' => $note_all,
                'category_all' => $category_all,
            ]);
        }

        elseif(Auth::user()->hasRole('user')){
            return "Hello";
        }
    }

    public function userall()
    {
        $data['data'] = User::orderBy('id','desc')->paginate(15);
        return view('admin.users.index',$data);
    }
    public function userhow($id)
    {
        $user = User::where('slug',$id)->first();
        return view('admin.users.detail',compact('user'));
    }

    public function notesll()
    {
        $data['data'] = Note::orderBy('id','desc')->paginate(6);
        return view('admin.notes.index',$data);
    }
    public function categoryll()
    {
        $data['data'] = Category::orderBy('id','desc')->paginate(6);
        return view('admin.categories.index',$data);
    }


}
