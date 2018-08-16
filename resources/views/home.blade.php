@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                        <div class="btn-group float-right">
                            <a class="btn btn-light" href="{{route('posts.create')}}">New post</a>
                            <a class="btn btn-light" href="{{route('posts.index')}}">Recent posts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
