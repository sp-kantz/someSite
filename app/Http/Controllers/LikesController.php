<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function likeStats($total, $likes){
        $dislikes = $total - $likes;

        if($total > 0){
            $likePer = $likes * 100 / $total;
            $dislikePer = $dislikes * 100 / $total;
        }
        else{
            $likePer = 100;
            $dislikePer = 100; 
        }

        return $total.",".$likes.",".$dislikes.",".$likePer.",".$dislikePer;
    }

    public function store($post_id, $val)
    {  
        $like = new Like;
        $like->post_id = $post_id;
        $like->value = $val;
        $like->user_id = auth()->user()->id;
        $like->save();

        $total = Like::where('post_id', $post_id)->count();
        $likes = Like::where('post_id', $post_id)->where('value', 1)->count();

        return $this->likeStats($total, $likes);
    }

    public function update($post_id)
    {        
        $like = Like::where('post_id', $post_id)->where('user_id', auth()->user()->id)->first();
        $like->value = $like->value ^ 1;
        $like->save();

        $total = Like::where('post_id', $post_id)->count();
        $likes = Like::where('post_id', $post_id)->where('value', 1)->count();

        return $this->likeStats($total, $likes);
    }

    public function destroy($post_id)
    {
        $like = Like::where('post_id', $post_id)->where('user_id', auth()->user()->id)->first();
        $like->delete();

        $total = Like::where('post_id', $post_id)->count();
        $likes = Like::where('post_id', $post_id)->where('value', 1)->count();

        return $this->likeStats($total, $likes);
    }
}
