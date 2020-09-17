<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PagesController extends Controller
{
    public function index(){

        $post = Post::orderBy('created_at', 'desc')->first();
        $comment = Comment::orderBy('created_at', 'desc')->first();
        $data = ['post'=>$post, 'comment'=>$comment];
        return view('pages.index')->with('data', ['post'=>$post, 'comment'=>$comment]);
    }

    public function about(){
        return view('pages.about');
    }
}
