@extends('layouts.app')

@section('content')
    @if ($post)
        <h2>{{$post->title}}</h2>
        <small>by {{$post->user->name}}</small></br>
        <small>Written: {{$post->created_at}}, Updated: {{$post->updated_at}}</small>
        <hr>
        <div>
            {{$post->body}}
        </div>
        <hr>
        @if (!Auth::guest())
            @if (Auth::user()->id == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn">Edit Post</a>
                
                <form action="{{Route('posts.destroy', $post->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif 
        @endif
                
        <div class="mt-3">
            @include('layouts.comments')
        </div>
    @else
        <p>No post found</p>
    @endif
@endsection