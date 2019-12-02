@extends('layouts.admin')

@section('content')


    @if(Session::has('deleted_post'))
        <div class="alert alert-danger" >{{session('deleted_post')}}</div>
    @endif
    @if(Session::has('updated_post'))
        <div class="alert alert-info" >{{session('updated_post')}}</div>
    @endif
    @if(Session::has('added_post'))
        <div class="alert alert-success" >{{session('added_post')}}</div>
    @endif


    <h1>Posts</h1>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <td>ID</td>
                <th>Owner</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Content</th>
                <th>View Post</th>
                @can('viewAdmin')
                <th>View Comments</th>
                @endcan
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
                @can('viewAdmin' , Auth::user())
                <th>Approvment</th>
                    @endcan
            </tr>
            </thead>
            <tbody>

            @if($posts)
                @foreach($posts as $post)
                    @if($post->is_active == 1 || Auth::user()->role->name == 'Administrator')
                    <tr>

                        <td>{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category->name}}</td>

                    @if($post->photo)
                        <td><img height="70px" width="100px" src="{{$post->photo->path}}"></td>
                    @else
                        <td>{{'user has no photo'}}</td>
                    @endif
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}
                        <td><a href="{{route('home.post', $post->id )}}">View Post</a>
                        @can('viewAdmin')
                        <td><a href="{{route('comments.show', $post->id )}}">View Comments</a>
                        @endcan
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        @can('update', $post)
                        <td><a href="{{route('posts.edit' , $post->id)}}"> Edit</a> </td>
                        @endcan
                        @can('viewAdmin' , Auth::user())
                            <td>

                            @if($post->is_active == 1)

                                {!!  Form::open(['action' => ['AdminPostController@approvment' , $post->id], 'method' => 'PUT']) !!}
                                @method('PUT')

                                <input type="hidden"  name="is_active" value="0" >

                                {!!  Form::submit('Un Approve!' , ['class' => 'btn btn-warning   ']) !!}

                                {!! Form::close() !!}

                            @else

                                {!!  Form::open(['action' => ['AdminPostController@approvment' , $post->id], 'method' => 'PUT']) !!}
                                @method('PUT')

                                <input type="hidden" name="is_active" value="1" >

                                {!!  Form::submit('Approve!' , ['class' => 'btn btn-success   ']) !!}

                                {!! Form::close() !!}

                            @endif
                        </td>
                        @endcan


                    </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>

        <table>

        </table>
    </div>

@endsection
