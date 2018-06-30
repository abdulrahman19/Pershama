@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col">
    <h1 class="title">Posts</h1>
    <div class="hlinks">
        <a href="/posts/create" type="button" class="btn btn-dark">New post</a>
    </div>
    </div>
</div>
<div class="row">
    <div class="col-9">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">User</th>
                    <th scope="col">Publish date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <th scope="row"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></th>
                    <th scope="row">{{ $post->user->name }}</th>
                    <td>{{ $post->created_at->toFormattedDateString() }}</td>
                    <td><a href="#">Edit</a></td>
                    <td><a href="#">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-2 offset-md-1 text-center">
        <h2>Archives</h2>
        <ul class="list-unstyled">
            <li><a href="?">All</a></li>
            @foreach ($archive as $stats)
                <li><a href="?month={{ $stats['month'] }}&year={{ $stats['year'] }}">{{ $stats['month'] }} {{ $stats['year'] }} ({{ $stats['published'] }})</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
