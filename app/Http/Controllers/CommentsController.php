<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Photo $photo)
    {

        $this->validate(request(), [
            'body' => 'required'
        ]);

        Comment::create([
            'body' => request('body'),
            'user_id' => "0",
            'photo_id' => $photo->id,
        ]);

        return back();
    }
}
