@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col">
        @yield('title')
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            @yield('posts_content')
        </div>
        <div class="col-2 offset-md-1 text-center">
            @include('posts.sidebar')
        </div>
    </div>
@endsection
