@extends('layouts.app')

@section('header_title', Auth::user()->name.'\'s Comments')

@section('content')
    <div class="card-header">Your Comments</div>
    <div class="card-body">
        @if (count($comments)>0)
            <table class="table table-striped">
                <tr>
                    <th>Comments</th>
                    <th>Posted</th>
                    <th></th>
                </tr>
                @foreach ($comments as $comment)
                    <tr>
                        <td>
                            <a class="dash-link" href="/posts/{{$comment->post_id}}#{{$comment->id}}">{{$comment->body}}</a>
                        </td>
                        <td>{{$comment->created_at}}</td>
                        
                        <td>
                            <form action="{{Route('deleteComment', $comment->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$comments->links()}}
        @else
            <p>You have no comments</p>
        @endif
    </div>
@endsection