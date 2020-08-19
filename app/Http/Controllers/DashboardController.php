<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Like;
use App\Post;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        return view('dashboard');
    }

    public function posts(){
        $posts = User::find(auth()->user()->id)->posts()->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.userPosts')->with('posts', $posts);
    }

    public function comments(){
        $comments = User::find(auth()->user()->id)->comments()->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.userComments')->with('comments', $comments);
    }

    public function likes(){
        $likes = Like::where('value', 1)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.userLikes')->with('likes', $likes);
    }

    public function dislikes(){
        $dislikes = Like::where('value', 0)->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.userDislikes')->with('dislikes', $dislikes);
    }
}
