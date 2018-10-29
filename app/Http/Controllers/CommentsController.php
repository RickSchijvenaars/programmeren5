<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Photo $photo)
    {
        $this->validate(request(), [
            'body' => 'required'
        ]);

        Comment::create([
            'body' => request('body'),
            'user_id' => Auth::id(),
            'photo_id' => $photo->id,
        ]);

        return back();
    }

    public function delete($id){
        Comment::where('id', $id)->delete();
        return back();
    }
}
