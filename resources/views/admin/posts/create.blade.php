@extends('layouts.admin')
@section('content')

    @include('includes.formerr')

    <h1>Create Posts</h1>
    {!!  Form::open(['action' => 'AdminPostController@store' , 'method' => 'POST', 'files'=> true]) !!}
    <div class="form-group">
        {!!  Form::label('title', 'Title')  !!}
        {!!  Form::text('title' , null ,['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">

        {!!  Form::label('body', 'Body')  !!}
        {!!  Form::textarea('body' , null ,['class'=> 'form-control' ,'rows'=>5]) !!}
    </div>

    <div class="form-group">
        {!!  Form::label('category', 'Category')  !!}
        {!!  Form::select('category_id' , [''=>'select option'] + $categoriesArr  , 0 ,['class'=> 'form-control']) !!}
    </div>


    <div class="form-group">
        {!!  Form::label('file', 'Image')  !!}
        {!!  Form::file('file' , ['class'=> 'form-control']) !!}

    </div>

    {!!  Form::submit('Create Post!' , ['class' => 'btn btn-primary   ']) !!}


    {!! Form::close() !!}



@endsection
