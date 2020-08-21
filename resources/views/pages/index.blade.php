@extends('layouts.app')

@section('header_title', 'Home')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                <h2>Laravel Blog Example<h2>
            </div>

            <div class="links">
                <a class='btn' href="/login">Login</a>
                <a href="/register">Register</a>
                
                <a href="/posts">Blog Posts</a>
                <a href="/about">About someBlog</a>
            </div>
            @if ($data['post'])
                <hr>
                <h4>Latest Post</h4>
                <div class="row ml-4">
                    <div class="col-md-8 col-sm-8">
                        <img style="width: 50%;" src="/storage/cover_images/{{$data['post']->cover_image}}" />
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a class="post_title" href="/posts/{{$data['post']->id}}">{{$data['post']->title}}</a>
                        <div class="row-md-4">
                            by <img width="35" height="35" src="/storage/profile_images/thumbnails/{{$data['post']->user->profile_image}}" />
                            <strong>{{$data['post']->user->name}}</strong>                            
                        </div>
                        <small>Written: {{$data['post']->created_at}}, Updated: {{$data['post']->updated_at}}</small>
                    </div>
                </div>
                @if($data['comment'])
                    <hr>
                    <h4>Latest Comment</h4>
                    <div class="row ml-4">
                        <div class="col-md-8 col-sm-8">
                            <div class="comment-text row" id="comment_text">{{$data['comment']->body}}</div>
                            <em> by </em>
                            <img width="35" height="35" src="/storage/profile_images/thumbnails/{{$data['comment']->user->profile_image}}" />
                            <strong>{{$data['comment']->user->name}}</strong>
                            
                            <small><em> on </em></small> 
                            <a class="post_title" href="/posts/{{$data['comment']->post->id}}#{{$data['comment']->id}}">{{$data['comment']->post->title}}</a>
                        </div>             
                    </div> 
                
                    </br>                                
                    
                @endif
            @endif
        </div>
    </div>
@endsection
