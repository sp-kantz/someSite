@extends('layouts.app')

@section('header_title', Auth::user()->name.'\'s Disliked Posts')

@section('content')
    <div class="card-header">Posts you dislike</div>
    <div class="card-body">
        @if (count($dislikes)>0)
            <table class="table table-striped">
                <tr>
                    <th>Posts</th>
                    <th>Disliked</th>
                </tr>
                @foreach ($dislikes as $dislike)
                    <tr>
                        <td>
                            <a href="/posts/{{$dislike->post->id}}">{{$dislike->post->title}}</a>
                        </td>
                        <td>{{$dislike->created_at}}</td>

                    </tr>
                @endforeach
            </table>
            {{$dislikes->links()}}
        @else
            <p>You have not disliked any posts</p>
        @endif  
    </div>
@endsection