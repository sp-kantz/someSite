@extends('layouts.app')

@section('content')
    <h1>Blog Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="well">
            <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                <small>Written: {{$post->created_at}}, Updated: {{$post->updated_at}}, by {{$post->user->name}}</small>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection