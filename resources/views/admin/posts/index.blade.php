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
                <th>Created</th>
                <th>Updated</th>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>

            @if($posts)
                @foreach($posts as $post)
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
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td><a href="{{route('posts.edit' , $post->id)}}"> Edit</a> </td>

                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
