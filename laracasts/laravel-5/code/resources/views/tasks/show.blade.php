@extends('layouts.master')

@section('content')
    <h1>{{ $task->body }}</h1>
    <p>{{ $task->created_at }}</p>
@endsection
