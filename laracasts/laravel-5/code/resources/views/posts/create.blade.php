@extends('layouts.master')
@section('content')

<h1 class="title">Publish a Post</h1>

<form method="POST" action="/posts">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Post title">
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" class="form-control" id="body" rows="3" placeholder="Post body"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Publish</button>
</form>

@endsection
