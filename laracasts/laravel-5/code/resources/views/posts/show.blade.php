@extends('layouts.master')
@section('content')

<h1 class="title">{{ $post->title }}</h1>
<p class="mb-5">{{ $post->body }}</p>

@if (count($post->comments))
<div class="comments border border-secondary rounded px-2">
    <h3 class="mt-3"><strong>Comments</strong></h3>
    <hr>
    @foreach ($post->comments as $comment)
    <div class="card mb-4">
        <div class="card-header">
            <span class="badge badge-primary">User</span> bla | <span class="badge badge-primary">Date</span> {{ $comment->created_at->diffForHumans() }}
        </div>
        <div class="card-body">
            <p>{{ $comment->body }}</p>
        </div>
    </div>
    @endforeach
</div>
@endif


@endsection
