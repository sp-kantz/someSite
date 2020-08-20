@extends('layouts.app')

@section('header_title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="col-md-8">
            <div class="col card justify-content-center">
                
                <div class="card-header">Dashboard</div>
                <div class="col-md-2">
                    <div class="row-md-2">
                        <img width="80" height="80" src="/storage/profile_images/{{Auth::user()->profile_image}}" />
                        <h3>{{Auth::user()->name}}</h3>
                    </div>
                </div>

                <div class="card-body">
                    <a href="/posts/create" class="btn btn-primary mr-auto">Create Post</a>
                    <a href="/dashboard/settings" class="btn btn-primary mr-auto">Settings</a>
                    <hr>
                    <h5>Your history</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="/dashboard/posts" class="btn btn-primary mr-auto">Posts</a></li>
                        <li class="list-group-item"><a href="/dashboard/comments" class="btn btn-primary mr-auto">Comments</a></li>
                        <li class="list-group-item"><a href="/dashboard/likes" class="btn btn-primary mr-auto">Liked Posts</a></li>
                        <li class="list-group-item"><a href="/dashboard/dislikes" class="btn btn-primary mr-auto">Disliked Posts</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
