@extends('layouts.master')

@section('title')
    Create a post
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/post.css') }}">
@endsection
@section('content')

    <div class="container">
        <div class="col-sm-8">
            <h3>Create a new post</h3>
            <br>
            <div class="create-form">
            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Title :</label>
                    <input class="form-control" type="text" name="title" required>
                </div>

                <div class="form-group">
                    <label>Description :</label>
                    <textarea class="form-control" type="tex" name="description" rows="12" required></textarea>
                </div>

                <div class="form-inline">
                    <div class="form-group">
                        <label>Upload a photo :</label>
                        <input class=" mx-sm-3" type="file" name="photo">
                        <small class="text-muted">Must be .png or .jpg</small>
                    </div>
                </div>
                <button class="btn btn-success float-right" type="submit">Create</button>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection