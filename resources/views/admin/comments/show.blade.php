@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0 )
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>Comment Author</th>
                    <th>Comment Author Email</th>
                    <th>Commment Content</th>
                    <th>Post </th>
                    <th>Aprrove or not</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($comments as $comment)

                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->user->email}}</td>
                        <td>{{$comment->comment}}</td>
                        <td><a href="{{route('home.post', $comment->post->id )}}">View Post</a>
                        </td>
                        <td>

                            @if($comment->is_active == 1)

                                {!!  Form::open(['action' => ['PostCommentController@update' , $comment->id], 'method' => 'PUT']) !!}
                                @method('PUT')

                                <input type="hidden"  name="is_active" value="0" >

                                {!!  Form::submit('Un Approve!' , ['class' => 'btn btn-warning   ']) !!}

                                {!! Form::close() !!}

                            @else

                                {!!  Form::open(['action' => ['PostCommentController@update' , $comment->id], 'method' => 'PUT']) !!}
                                @method('PUT')

                                <input type="hidden" name="is_active" value="1" >

                                {!!  Form::submit('Approve!' , ['class' => 'btn btn-success   ']) !!}

                                {!! Form::close() !!}

                            @endif
                        </td>
                        <td>

                            {!!  Form::open(['action' => ['PostCommentController@destroy' , $comment->id], 'method' => 'PUT']) !!}
                            @method('DELETE')


                            {!!  Form::submit('Delete Comment!' , ['class' => 'btn btn-danger   ']) !!}


                            {!! Form::close() !!}



                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    @else
        <h2>There in no comments </h2>
    @endif


@endsection
