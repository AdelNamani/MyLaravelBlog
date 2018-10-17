@extends('layouts.master')

@section('title')
    Recent posts
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/post.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="col">
            <h3>Recent posts</h3>
            <br>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Learn more</th>
                    <th>Created on</th>
                </tr>
                </thead>
                <tbody>
                @if($posts)
                    @foreach($posts as $post)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->name }}</td>
                            <td>
                                <a href="{{route('posts.show',['post'=>$post->id])}}">view more</a>
                            </td>
                            <td>{{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y')  }}</td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-center text-primary">No Posts created Yet!</p>
                @endif
            </table>
            <Br>
        </div>
    </div>
@endsection
@section('scripts')

@endsection