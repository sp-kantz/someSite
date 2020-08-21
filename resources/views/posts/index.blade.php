@extends('layouts.app')

@section('header_title', 'Blog')

@section('content')
    <h1>Blog Posts</h1>
    <hr>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="well">
                <div class="row mb-1">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 50%;" src="/storage/cover_images/{{$post->cover_image}}" />
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a class="post_title" href="/posts/{{$post->id}}">{{$post->title}}</a>
                        <div class="row-md-4">
                            by <img width="35" height="35" src="/storage/profile_images/thumbnails/{{$post->user->profile_image}}" />
                            <strong>{{$post->user->name}}</strong>                            
                        </div>
                        <small>Written: {{$post->created_at}}, Updated: {{$post->updated_at}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        <hr>
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection