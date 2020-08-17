<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'body'=>'required'
        ]);
        
        $comment = new Comment;
        $comment->body=$request->input('body');
        $comment->user_id=auth()->user()->id;
        $comment->post_id=$post_id;
        $comment->save();
        return back()->with('success', 'Comment Created');
    }

    public function destroy($id)
    {
        $comment=Comment::find($id);

        if(auth()->user()->id !== $comment->user_id) {
            return back()->with('error', 'Unauthorized Action');
        }

        $comment->delete();

        return back()->with('success', 'Post deleted');
    }
}
