@extends('layouts.admin')
@section('content')

<h1 style="font-family: 'Comic Sans MS'">Hello {{Auth::user()->name}}</h1>
@endsection
