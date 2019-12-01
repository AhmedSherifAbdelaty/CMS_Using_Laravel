@extends('layouts.admin')
@section('content')

@include('includes.formerr')

    <h1>Create Users</h1>
    {!!  Form::open(['action' => 'AdminUserController@store' , 'method' => 'POST', 'files'=> true]) !!}
    <div class="form-group">
    {!!  Form::label('name', 'Name')  !!}
    {!!  Form::text('name' , null ,['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">

    {!!  Form::label('email', 'Email')  !!}
    {!!  Form::email('email' , null ,['class'=> 'form-control']) !!}
    </div>

    <div class="form-group">
    {!!  Form::label('role_id', 'Role')  !!}
    {!!  Form::select('role_id' ,[''=>'select option'] + $rolesArr  , 0 ,['class'=> 'form-control']) !!}
    </div>
    <div class="form-group">
    {!!  Form::label('status', 'Status')  !!}
    {!!  Form::select('is_active' ,[1=>'Active' , 0=>'Not Active'], 0 ,['class'=> 'form-control']) !!}
    </div>


    <div class="form-group">
        {!!  Form::label('password', 'Password')  !!}
        {!!  Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!!  Form::label('file', 'Photo')  !!}
        {!!  Form::file('file' , ['class'=> 'form-control']) !!}

    </div>

    {!!  Form::submit('Create User!' , ['class' => 'btn btn-primary   ']) !!}


    {!! Form::close() !!}



    @endsection
