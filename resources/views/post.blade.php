@extends('layouts.blog-post')

@section('content')

    @if(Session::has('comment_added'))
        <div class="alert alert-success" >{{session('comment_added')}}</div>
    @endif

    @if(Session::has('comment_edited'))
        <div class="alert alert-info" >{{session('comment_edited')}}</div>
    @endif
    @if(Session::has('comment_deleted'))
        <div class="alert alert-danger" >{{session('comment_deleted')}}</div>
    @endif
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
{{--    <img class="img-responsive" src="http://placehold.it/900x300" alt="">--}}
    @if($post->photo)
    <img  width=700px" height="300px" src="{{$post->photo->path}}" alt="">
    @endif
    <hr>

    <!-- Post Content -->
    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!!  Form::open(['action' => ['PostCommentController@store'], 'method' => 'POST']) !!}
        {!!  Form::label('comment', 'Body')  !!}
        {!!  Form::textarea('comment' , null ,['class'=> 'form-control' , 'rows' => '3']) !!}
         <input type="hidden" name="post_id" value="{{$post->id}}" >
        <br>

        {!!  Form::submit('Submit comment' , ['class' => 'btn btn-info   ']) !!}


        {!! Form::close() !!}


{{--        <form role="form">--}}
{{--            <div class="form-group">--}}
{{--                <textarea class="form-control" rows="3"></textarea>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--        </form>--}}


    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    <div class="media">
{{--        <a class="pull-left" href="#">--}}
{{--            <img class="media-object" src="http://placehold.it/64x64" alt="">--}}
{{--        </a>--}}


        @if(count($comments))

            @foreach($comments as $comment)
        @if($comment->is_active == 1)

        <div class="media-body">
            <h4 class="media-heading">{{$comment->user->name}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->comment}}
            <br>
            <br>
            @can('update' ,$comment)
        {!!link_to_route('comment.edit', $title = 'Edit comment', $parameters = [$comment->id],
            $attributes = ['class' => 'btn btn-primary'])
           !!}
            @endcan
            <br>
            <br>


            <!-- Nested Comment -->
{{--            <div class="media">--}}
{{--                <a class="pull-left" href="#">--}}
{{--                    <img class="media-object" src="http://placehold.it/64x64" alt="">--}}
{{--                </a>--}}
{{--                <div class="media-body">--}}
{{--                    <h4 class="media-heading">Nested Start Bootstrap--}}
{{--                        <small>August 25, 2014 at 9:30 PM</small>--}}
{{--                    </h4>--}}
{{--                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- End Nested Comment -->
        </div>
                <br>
                @endif
            @endforeach


        @endif
    </div>



    <!-- Comment -->




    @endsection
