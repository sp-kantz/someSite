@extends('layouts.app')

@section('header_title', Auth::user()->name.'\'s Posts')

@section('content')
    <div class="card-header">Your Posts</div>
    <a href="/posts/create" class="btn btn-primary mr-auto">Create Post</a>
    <div class="card-body">
        @if (count($posts)>0)
            <table class="table table-striped">
                <tr>
                    <th>Posts</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <a class="dash-link" href="/posts/{{$post->id}}">{{$post->title}}</a>
                        </td>
                        <td>{{$post->created_at}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td>
                            <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a>
                        </td>
                        <td>
                            <form action="{{Route('posts.destroy', $post->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$posts->links()}}
        @else
            <p>You have no posts</p>
        @endif  
    </div>
@endsection