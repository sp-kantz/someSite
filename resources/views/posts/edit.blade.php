@extends('layouts.app')

@section('header_title', 'Edit Post')

@section('content')
    <h2>Edit Post</h2>
    <form method="POST" action="{{Route('posts.update', $post->id)}}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title" value="{{$post->title}}" >
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" placeholder="Body">{{$post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
@endsection