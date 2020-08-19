@extends('layouts.app')

@section('header_title', 'Home')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                <h2>Laravel Blog Example<h2>
            </div>

            <div class="">
                <a class='btn' href="/login">Login</a>
                <a href="/register">Register</a>
                
                <a href="/posts">Blog Posts</a>
                <a href="/about">About someBlog</a>
            </div>
        </div>
    </div>
@endsection
