@extends('layouts.master')

@section('title')
    {{ $post->title }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/post.css') }}">
@endsection
@section('content')

    <div class="container">
        <div class="row post-title">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="row">
            <div class="col-auto">
                <img src="@if($author->photo=='')
                {{URL::to('img/default.png')}}
                @else
                {{asset("storage/".$author->photo)}}
                @endif
                        " class="author-picture">
            </div>
            <div class="col">
                <h3>{{$author->name}}</h3>
                <span class="post-info text-muted">Created on :{{Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</span>
                @if ((Auth::check())&&(Auth::user()->id==$author->id))
                    <br><a href="{{route('posts.edit',['post'=>$post])}}" class="btn btn-link btn-sm" >Edit</a>
                <form method="POST" action="{{route('posts.destroy',['post'=>$post])}}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link btn-sm">Delete</button>
                </form>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="post-descrition">
                    <p>{{ $post->description }}</p>
                </div>
            </div>
            @if ($post->photo!='')
                <div class="col-xl">
                    <div class="post-image">
                        <img  src="{{asset('storage/'.$post->photo)}}" class="post-picture responsive-img main-img">
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('scripts')

@endsection