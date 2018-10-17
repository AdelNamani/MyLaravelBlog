@extends('layouts.master')

@section('title')
    {{$user->name}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/account.css') }}">
@endsection
@section('content')
    <div class="container account-info">
        <div class="@if ($errors->has('photo')) has-error @endif">
            <img id="profil-picture"  src="@if($user->photo=='')
            {{URL::to('img/default.png')}}
            @else
            {{asset("storage/".$user->photo)}}
            @endif
                    " class="profile-picture mx-auto d-block">
            @foreach ($errors->get('photo') as $message)
                <span class="help-block" > {{$message}} </span>
            @endforeach
        </div>
        <form method="post" action="{{route('users.update', $user)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div class="form-group @if ($errors->has('name')) has-error @endif">
                <label>Name</label>
                <input class="form-control" type="text" name="name"  value="{{ $user->name }}" />
                @foreach ($errors->get('name') as $message)
                    <span class="help-block" > {{$message}} </span>
                @endforeach
            </div>

            <div class="form-group @if ($errors->has('email')) has-error @endif">
                <label>Email</label>
                <input class="form-control" type="email" name="email"  value="{{ $user->email }}" />
                @foreach ($errors->get('email') as $message)
                    <span class="help-block" > {{$message}} </span>
                @endforeach
            </div>

            <div class="form-group @if ($errors->has('password')) has-error @endif">
                <label>Password</label>
                <input class="form-control" type="password" name="password" value="123456" />
                @foreach ($errors->get('email') as $message)
                    <span class="help-block" > {{$message}} </span>
                @endforeach
            </div>

            <div class="form-group">
                <label>Confirm password</label>
                <input class="form-control" type="password" name="password_confirmation" value="123456" />
                @foreach ($errors->get('password') as $message)
                    <span class="help-block" > {{$message}} </span>
                @endforeach
            </div>

            <input type="file" name="photo" hidden id="update-photo">

            <button class="btn btn-success float-right" type="submit">Send</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{URL::to('js/account.js')}}"></script>
@endsection