@extends('layouts.master')

@section('title')
    Create a post
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/post.css') }}">
@endsection
@section('content')
    @foreach($posts as $post)


    @endforeach
@endsection
@section('scripts')

@endsection