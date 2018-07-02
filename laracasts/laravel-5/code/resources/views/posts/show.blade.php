@extends('layouts.posts')

@section('title')
    <h1 class="title">{{ $post->title }}</h1>
    @if (count($post->tags))
    <div>
        @foreach ($post->tags as $tag)
            <span class="badge badge-primary"><a href="/posts/tags/{{ $tag->name }}" class="text-light">{{ $tag->name }}</a></span>
        @endforeach
    </div>
    @endif
    <div class="user-name">By: <em>{{ $post->user->name }}</em></div>
@endsection

@section('posts_content')
    <p class="mb-5">{{ $post->body }}</p>
    @include('posts.comments')
@endsection
