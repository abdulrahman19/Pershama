@extends('layouts.master')

@section('content')
    <h1 class="title">{{ $task->body }}</h1>
    <p>{{ $task->created_at }}</p>
@endsection
