@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card">
                <div class="card-header">Dashboard</div>
                <a href="/posts/create" class="btn btn-primary mr-auto">Create Post</a>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($data['posts'])>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Posts</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                            @foreach ($data['posts'] as $post)
                                <tr>
                                    <td>
                                        <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->updated_at}}</td>
                                    <td>
                                        <a href="/posts/{{$post->id}}/edit" class="btn">Edit</a>
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
                    @else
                        <p>You have no posts</p>
                    @endif      
                    
                    @if (count($data['comments'])>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Comments</th>
                                <th>Posted</th>
                                <th></th>
                            </tr>
                            @foreach ($data['comments'] as $comment)
                                <tr>
                                    <td>
                                        <a href="/posts/{{$comment->post_id}}#{{$comment->id}}">{{$comment->body}}</a>
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                    
                                    <td>
                                        <form action="{{Route('deleteComment', $comment->id)}}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
