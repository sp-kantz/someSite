@if (Auth::guest())
        <a class="btn btn-dark" href="/login">Login to Post a Comment</a>
    
@else

    <form action="{{Route('createComment', $post->id)}}" method="POST">
        @csrf
        <div class="form-group">
            <div class="col-md-8">       
                <textarea id="comment" type="text" class="form-control" name="body" rows="3"></textarea>
                <button type="submit" class="btn btn-primary">
                    {{ __('Comment') }}
                </button>
            </div>
        </div>
    </form>
    
@endif

<hr>

<div class="panel panel-default">
    <div class="panel-heading">
        <label class="panel-title">Recent Comments ({{count($post->comments)}}):</label>
    </div>
    <div class="panel-body">
        @if (count($post->comments)>0)
            <ul class="list-group"> 
                @foreach ($post->comments()->orderBy('created_at', 'desc')->get() as $comment)     
                    <li class="list-group-item comment_box" id="{{$comment->id}}">
                        <div class="row">
                            <div class="pl-3">
                                <div class="row">
                                    <div class="mr-3"><strong>{{$comment->user->name}}</strong></div><small><em> on </em>{{$comment->created_at}}</small>
                                    @if (!Auth::guest())
                                        @if (Auth::user()->id == $comment->user_id)                                            
                                            <form method="POST" action="{{Route('deleteComment', $comment->id)}}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-xs ml-3 mb-2" title="Delete">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>                                            
                                        @endif                     
                                    @endif 
                                </div>                                
                                <div class="comment-text" id="comment_text">{{$comment->body}}</div>                                    
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No comments yet</p>
        @endif
    </div>
</div>