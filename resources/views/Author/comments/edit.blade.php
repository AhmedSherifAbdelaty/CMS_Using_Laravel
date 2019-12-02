@extends('layouts.admin')



@section('content')

    @include('includes.formerr')


    <div class="row">

        <div class="col-sm-6">
            {!!  Form::model($comment , ['action' =>['AuthorCommentController@update' , $comment->id] , 'method' => 'put']) !!}
            @method('put')

            <div class="form-group">
                {!!  Form::label('comment', 'Body')  !!}
                {!!  Form::textarea('comment' , null ,['class'=> 'form-control' , 'rows' => '3']) !!}
            </div>

            {!!  Form::submit('Update comment' , ['class' => 'btn btn-info  ']) !!}
            {!! Form::close() !!}

            <br>
            {!!  Form::open(['action' =>['AuthorCommentController@destroy' , $comment->id] , 'method' => 'delete']) !!}
            @method('DELETE')
            {!!  Form::submit('Delete comment!' , ['class' => 'btn btn-danger   ']) !!}
            {!! Form::close() !!}

        </div>

    </div>
@endsection
