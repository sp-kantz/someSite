@if (Auth::guest())
        <a class="btn btn-dark" href="/login">Login to Post a Comment</a>
    
@else
    <form action="{{Route('createComment', $data['post']->id)}}" method="POST">
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

<div class="comment-section">
    <div class="heading">
        <label class="title">Recent Comments ({{count($data['comments'])}}):</label>
    </div>
    <div class="comments">
        @if (count($data['comments'])>0)
            <ul class="list-group"> 
                @foreach ($data['comments'] as $comment)     
                    <li class="list-group-item comment_box" id="{{$comment->id}}">
                        <div class="row m-md-4">
                            <div class="pl-2">
                                <div class="mr-3 row-md-2">
                                    <img width="35" height="35" src="/storage/profile_images/thumbnails/{{$comment->user->profile_image}}" />
                                    <strong>{{$comment->user->name}}</strong>
                                    <small><em> on </em>{{$comment->created_at}}</small>                
                                </div> 
                                </br>                                
                                <div class="comment-text row" id="comment_text">{{$comment->body}}
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