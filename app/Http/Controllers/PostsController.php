<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required'
        ]);
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $liked = -1;
        if (auth()->user()){
            foreach ($post->likes as $like){
                if ($like->user_id == auth()->user()->id){
                    $liked = $like->value;
                }
            }
        }

        $total = $post->likes()->count();
        $likes = $post->likes()->where('value', 1)->count();
        $dislikes = $total - $likes;
        if($total>0){
            $likePer = $likes * 100 / $total;
            $dislikePer = $dislikes * 100 / $total;
        }
        else{
            $likePer = 100;
            $dislikePer = 100; 
        }
        
        return view('posts.show')->with('data', 
            ['post'=>$post,
            'total'=>$total,
            'likes'=>$likes,
            'dislikes'=>$dislikes,
            'likePer'=>$likePer,
            'dislikePer'=>$dislikePer,
            'liked'=>$liked]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Action');
        }
        
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required'
        ]);
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Action');
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted');
    }
}
