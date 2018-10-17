@extends('layouts.master')

@section('title')
    Edit {{$post->title}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/post.css') }}">
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <h3>Edit your post :</h3>
        </div>
        <div class="row">
            <div class="col">
                <br>
                <div class="create-form">
                    <form action="{{route('posts.update',$post)}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group @if ($errors->has('title')) has-error @endif">
                            <label>Title :</label>
                            <input value="{{$post->title}}" class="form-control" type="text" name="title" required>
                            @foreach ($errors->get('title') as $message)
                                <span class="help-block" > {{$message}} </span>
                            @endforeach
                        </div>

                        <div class="form-group @if ($errors->has('description')) has-error @endif">
                            <label>Description :</label>
                            <textarea class="form-control" type="text" name="description" rows="10"
                                      required>{{$post->description}}</textarea>
                            @foreach ($errors->get('description') as $message)
                                <span class="help-block" > {{$message}} </span>
                            @endforeach
                        </div>

                        <div @if ($post->photo!='') hidden @endif class="form-inline">
                            <div class="form-group">
                                <label>Upload a photo :</label>
                                <input id="upload-photo" class=" mx-sm-3" type="file" name="photo">
                                <small class="text-muted">Must be .png or .jpg</small>
                            </div>
                            <button hidden type="submit" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($post->photo!='')
            <div class="col-xl">
                <div class="post-image">
                    <img  src="{{asset('storage/'.$post->photo)}}" class="post-picture-update responsive-img main-img">
                </div>
                @foreach ($errors->get('photo') as $message)
                    <span class="help-block" > {{$message}} </span>
                @endforeach
                <button id="photo" class="btn btn-link float-right">Update picture</button>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-info float-right" id="submit-replace">Save changes</button>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{URL::to('js/post.js')}}"></script>
@endsection