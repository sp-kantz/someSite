@extends('layouts.app')

@section('header_title', Auth::user()->name.'\'s Liked Posts')

@section('content')
    <div class="card-header">Posts you like</div>
    <div class="card-body">
        @if (count($likes)>0)
            <table class="table table-striped">
                <tr>
                    <th>Posts</th>
                    <th>Liked</th>
                </tr>
                @foreach ($likes as $like)
                    <tr>
                        <td>
                            <a class="dash-link" href="/posts/{{$like->post->id}}">{{$like->post->title}}</a>
                        </td>
                        <td>{{$like->created_at}}</td>
                    </tr>
                @endforeach
            </table>
            {{$likes->links()}}
        @else
            <p>You have no posts</p>
        @endif  
    </div>
@endsection