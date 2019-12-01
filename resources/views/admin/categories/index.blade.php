@extends('layouts.admin')



@section('content')


    @include('includes.formerr')


    <h3>Categories</h3>

<div class="row">

    <div class="col-sm-6">

        {!!  Form::open(['action' => ['AdminCategoryController@store' ], 'method' => 'post']) !!}

        {!!  Form::label('name', 'Name')  !!}
        {!!  Form::text('name' , null ,['class'=> 'form-control']) !!}

        <br>

        {!!  Form::submit('Create Category!' , ['class' => 'btn btn-info   ']) !!}


        {!! Form::close() !!}



    </div>

    <div class="col-sm-6">
        @if($categories)

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Updated at</th>
                </tr>

                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('categories.edit' , $category->id)}}">{{$category->name}}</a></td>
                        <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                        <td>{{ $category->updated_at ? $category->updated_at->diffForHumans() : 'no date'}}</td>

                    </tr>

                @endforeach
            </table>

        @endif
    </div>
</div>
    @endsection
