@extends('layouts.app')

@section('content')
    <h2>Create Post</h2>
    <form method="POST" action="{{Route('posts.store')}}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" placeholder="Title" type="text" id="title" name="title">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control" placeholder="Body"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
@endsection