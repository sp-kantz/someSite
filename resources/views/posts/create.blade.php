@extends('layouts.app')

@section('header_title', 'Create Post')

@section('content')
    <h2>Create Post</h2>
    <form method="POST" action="{{Route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" placeholder="Title" type="text" id="title" name="title">
            <hr>
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" placeholder="Body"></textarea>
            <hr>
            <input type="file" name="cover_image" />
        </div>
        
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection