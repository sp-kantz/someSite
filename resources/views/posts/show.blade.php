@extends('layouts.app')

@section('header_title', $data['post']->title)

@section('header_links')
    <link href="{{ URL::asset('css/showPost.css') }}" rel="stylesheet">
    @if (!Auth::guest())
        <script src="/js/showPost.js"></script>
    @endif
@endsection

@section('content')
    @if ($data['post'])
        <div class="container" post_id={{$data['post']->id}} id="post">
            <div class="label-info" id="status"></div>
            <h2>{{$data['post']->title}}</h2>
            <small>by {{$data['post']->user->name}}</small></br>
            <small>Written: {{$data['post']->created_at}}, Updated: {{$data['post']->updated_at}}</small>
            <hr>
            <div>
                {{$data['post']->body}}
            </div>
            <hr>

            <div id="reviews">
                <div id="likes" style="width:{{$data['likePer']}}%">
                    {{$data['likes']}}
                </div>
                <div id="dislikes" style="width:{{$data['dislikePer']}}%">
                    {{$data['dislikes']}}
                </div>
            </div>

            @if (!Auth::guest())

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
                    <a href="/posts/{{$data['post']->id}}/edit" class="btn">Edit Post</a>
                    
                    <form action="{{Route('posts.destroy', $data['post']->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif 
            @endif
                    
            <div class="mt-3">
                @include('layouts.comments')
            </div>
        </div>
    @else
        <p>No post found</p>
    @endif
@endsection