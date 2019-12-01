@extends('layouts.admin')



@section('content')

    @include('includes.formerr')


    <h3>Categories</h3>

    <div class="row">

        <div class="col-sm-6">

            {!!  Form::model($category ,['action' => ['AdminCategoryController@update' , $category->id ], 'method' => 'PUT']) !!}
            @method('PUT')
            {!!  Form::label('name', 'Name')  !!}
            {!!  Form::text('name' , null ,['class'=> 'form-control']) !!}

            <br>

            {!!  Form::submit('Edit Category!' , ['class' => 'btn btn-info   ']) !!}

            {!! Form::close() !!}


        </div>

    </div>
    <br>
    <div class="row">

        <div class="col-sm-6">
            {!!  Form::open(['action' =>['AdminCategoryController@destroy' , $category->id] , 'method' => 'delete']) !!}
            @method('DELETE')
            {!!  Form::submit('Delete Category!' , ['class' => 'btn btn-danger col-sm-4  ']) !!}
            {!! Form::close() !!}
        </div>

    </div>
@endsection
