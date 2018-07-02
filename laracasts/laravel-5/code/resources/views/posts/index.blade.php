@extends('layouts.posts')

@section('title')
    <h1 class="title">Posts</h1>
    <div class="hlinks">
        <a href="/posts/create" type="button" class="btn btn-dark">New post</a>
    </div>
@endsection

@section('posts_content')
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">User</th>
                <th scope="col">Publish date</th>
                <th scope="col">tags</th>
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
                <td>
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-primary"><a href="/posts/tags/{{ $tag->name }}" class="text-light">{{ $tag->name }}</a></span>
                    @endforeach
                </td>
                <td><a href="#">Edit</a></td>
                <td><a href="#">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
