@extends('layouts.master')

@section('content')
    <h1 class="title">{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
@endsection
