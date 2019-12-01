@extends('layouts.admin')
@section('content')
    @if(Session::has('deleted_user'))
        <div class="alert alert-danger" >{{session('deleted_user')}}</div>
    @endif
    @if(Session::has('updated_user'))
        <div class="alert alert-info" >{{session('updated_user')}}</div>
    @endif
    @if(Session::has('added_user'))
        <div class="alert alert-success" >{{session('added_user')}}</div>
    @endif

    <h1>users</h1>

    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
             <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
              <th>Role</th>
              <th>is Active</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Action</th>


          </tr>
        </thead>
        <tbody>

        @if($users)
        @foreach($users as $user)
        <tr>

            <td>{{$user->id}}</td>
            @if($user->photo)
            <td><img height="70px" width="70px" src="{{$user->photo->path}}"></td>
            @else
            <td>{{'user has no photo'}}</td>
            @endif

            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->is_active === 1? 'active' :'not active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td><a href="{{route('users.edit' , $user->id)}}"> Edit</a> </td>

        </tr>

        @endforeach
        @endif
{{--          <tr>--}}
{{--            <td>John</td>--}}
{{--            <td>Doe</td>--}}
{{--            <td>john@example.com</td>--}}
{{--          </tr>--}}
{{--         --}}
        </tbody>
      </table>
    </div>
@endsection
