@extends('layouts.master')
@section('content')
<h1 class="title">Posts</h1>
<div class="hlinks">
    <a href="/posts/create" type="button" class="btn btn-dark">New post</a>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Publish date</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th scope="row"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></th>
            <td>{{ $post->created_at->toFormattedDateString() }}</td>
            <td><a href="#">Edit</a></td>
            <td><a href="#">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
