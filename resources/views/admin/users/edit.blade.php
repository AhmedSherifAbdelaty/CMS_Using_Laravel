@extends('layouts.admin')
@section('content')

    @include('includes.formerr')

    <h1>Edit Users</h1>

    <div class="col-sm-3">
        @if($user->photo)
        <img width="250px" height="250"  src="{{$user->photo->path}}">
        @else
        @endif
    </div>

    <div class="col-sm-9">

    {!!  Form::model($user ,['action' => ['AdminUserController@update' , $user->id] , 'method' => 'POST', 'files'=> true]) !!}
    @method('PUT')
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


        <div class="form-group">
    {!!  Form::submit('Edit User!' , ['class' => 'btn btn-info col-sm-4  ']) !!}

        </div>

        {!! Form::close() !!}

        <div class="form-group">
        {!!  Form::open(['action' =>['AdminUserController@destroy' , $user->id] , 'method' => 'delete']) !!}
        @method('DELETE')
        {!!  Form::submit('Delete User!' , ['class' => 'btn btn-danger col-sm-4  ']) !!}
        {!! Form::close() !!}
        </div>

        </div>
    </div>

@endsection
