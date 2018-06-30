@extends('layouts.posts')

@section('title')
    <h1 class="title">{{ $post->title }}</h1>
    <div class="user-name">By: <em>{{ $post->user->name }}</em></div>
@endsection

@section('posts_content')
    <p class="mb-5">{{ $post->body }}</p>
    @include('posts.comments')
@endsection
