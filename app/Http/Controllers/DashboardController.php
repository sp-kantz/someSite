<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Like;

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
        return view('dashboard.dashboard');
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

    public function settings(){
        return view('dashboard.settings');
    }

    public function saveSettings(Request $request){
        $this->validate($request, [
            'profile_image'=>'image|nullable|max:1999'
        ]);

        $user = User::find(auth()->user()->id);

        if($request->theme != $user->theme){
            $user->theme = $user->theme ^ 1;
        }

        $upload = $request->file('profile_image');
        
        if($upload){

            $file = $upload->getClientOriginalName();
            $name = pathinfo($file, PATHINFO_FILENAME);             
            $stamp = time();
            $extension = $upload->getClientOriginalExtension();

            $filename = $name.'_'.$stamp.'.'.$extension;
            // $filenameThumb = $name.'_'.$stamp.'.'.$extension;
            // $path = $upload->storeAs('public/profile_images/original', $filename);
            $path = $upload->storeAs('public/profile_images', $filename);
            
            $temp_path='public/temp/'.$filename;

            $thumb_w = 100;
            $thumb_h = 100;
            list($src_w, $src_h, $src_type)=getimagesize($upload);

            switch($src_type)
            {
                case IMAGETYPE_JPEG:
                    $source_gd_image = imagecreatefromjpeg($upload);
                    break;
    
                case IMAGETYPE_PNG:
                    $source_gd_image = imagecreatefrompng($upload);
                    break;
            }

            $srcAspectRatio = $src_w / $src_h;
            $thumbnailAspectRatio = $thumb_w / $thumb_h;

            if($src_w <= $thumb_w && $src_h <= $thumb_h)
            {
                $thumb_w=(int)($thumb_h * $srcAspectRatio);
                $thumb_h=(int)($thumb_w / $srcAspectRatio);
            }
            elseif($thumbnailAspectRatio > $srcAspectRatio)
            {
                $thumb_w=(int)($thumb_h * $srcAspectRatio);
            }
            else
            {
                $thumb_h=(int)($thumb_w / $srcAspectRatio);
            }
    
            $thumbnail_gd_image = imagecreatetruecolor($thumb_w, $thumb_h);
    
            imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
    
            imagejpeg($thumbnail_gd_image, 'storage/profile_images/thumbnails/'.$filename, 100);
    
            imagedestroy($source_gd_image);
            imagedestroy($thumbnail_gd_image);

            Storage::delete('public/profile_images/'.$user->profile_image);
            Storage::delete('public/profile_images/thumbnails/'.$user->profile_image);
            $user->profile_image = $filename;
        }

        
        $user->save();

        return back()->with('success', 'Settings Saved');
    }
}
