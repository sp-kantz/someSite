@extends('layouts.app')
@if($data['post'])
    @section('header_title', $data['post']->title)
@endif

@section('header_links')
    <link href="{{ URL::asset('css/showPost.css') }}" rel="stylesheet">
    @if (!Auth::guest())
        <script src="/js/showPost.js"></script>
    @endif
@endsection

@section('content')
    @if ($data['post'])
        <div class="container" post_id={{$data['post']->id}} id="post">
            <h2>{{$data['post']->title}}</h2>
            <div class="row">
                <div class="mr-4">
                    <div class="row-md-8">
                        <img width="35" height="35" src="/storage/profile_images/thumbnails/{{$data['post']->user->profile_image}}" />
                        <strong>by {{$data['post']->user->name}}</strong>
                        <small>Written: {{$data['post']->created_at}}, Updated: {{$data['post']->updated_at}}</small>
                    </div>
                </div>
            </div>
            <hr>
            @if ($data['post']->cover_image !== 'noimage.jpg')
                <img style="width: 50%" src="/storage/cover_images/{{$data['post']->cover_image}}" />
            @endif

            <div>
                {{$data['post']->body}}
            </div>
            <hr>

            <div id="reviews" class="ml-4">
                <div id="likes" style="width:{{$data['likePer']}}%">
                    {{$data['likes']}}
                </div>
                <div id="dislikes" style="width:{{$data['dislikePer']}}%">
                    {{$data['dislikes']}}
                </div>
            </div>

            @if (!Auth::guest())
                <div class="row ml-4">
                    <div id="likeBtns">
                        <input type="button" value="+" id="likeBtn" onClick="likeAction()" 
                            class="btn btn-outline-primary 
                            @if ($data['liked']==1)
                                active
                            @endif" />
                        <input type="button" value="-" id="dislikeBtn" onClick="likeAction()" 
                            class="btn btn-outline-danger
                            @if ($data['liked']==0)
                                active
                            @endif" />
                    </div>
                    @if (Auth::user()->id == $data['post']->user_id)
                        <div class="ml-auto">
                            <a href="/posts/{{$data['post']->id}}/edit" class="btn btn-dark">Edit Post</a>
                            
                            <form action="{{Route('posts.destroy', $data['post']->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>    
                    @endif
                </div> 
            @endif
                    
            <div class="mt-3">
                @include('layouts.comments')
            </div>
        </div>
    @else
        <p>No post found</p>
    @endif
@endsection