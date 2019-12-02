@extends('layouts.admin')
@section('content')

    @include('includes.formerr')


    <h1>Edit Posts</h1>
    {!!  Form::model($post,['action' => ['AdminPostController@update' , $post->id] , 'method' => 'POST', 'files'=> true]) !!}
    @method('PUT')
    <div class="form-group">
        {!!  Form::label('title', 'Title')  !!}
        {!!  Form::text('title' , null ,['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">

        {!!  Form::label('body', 'Body')  !!}
        {!!  Form::textarea('body' , null ,['class'=> 'form-control' ,'rows'=>5]) !!}
    </div>

    {{--    <div class="form-group">--}}
    {{--        {!!  Form::label('role_id', 'Role')  !!}--}}
    {{--        {!!  Form::select('role_id' ,[''=>'select option'] + $rolesArr  , 0 ,['class'=> 'form-control']) !!}--}}
    {{--    </div>--}}

    <div class="form-group">
        {!!  Form::label('category', 'Category')  !!}
        {!!  Form::select('category_id' ,[''=>'select option'] + $categoriesArr, 0 ,['class'=> 'form-control']) !!}
    </div>


    <div class="form-group">
        {!!  Form::label('file', 'Image')  !!}
        {!!  Form::file('file' , ['class'=> 'form-control']) !!}
    </div>


    <div class="form-group">

        @can('edit' , $post)
    {!!  Form::submit('Edit Post!' , ['class' => 'btn btn-primary col-sm-4 ']) !!}
        @endcan

    {!! Form::close() !!}
    </div>


    <div class="form-group">
        {!!  Form::open(['action' =>['AdminPostController@destroy' , $post->id] , 'method' => 'delete']) !!}
        @method('DELETE')
        {!!  Form::submit('Delete Post!' , ['class' => 'btn btn-danger col-sm-4  ']) !!}
        {!! Form::close() !!}
    </div>

@endsection
