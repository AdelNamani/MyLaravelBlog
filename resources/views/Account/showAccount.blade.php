@extends('layouts.master')

@section('title')
    {{$user->name}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/account.css') }}">
@endsection
@section('content')
    <div>
        <img  src="@if($user->photo=='')
                    {{URL::to('img/default.png')}}
                @else
                    {{asset("storage/".$user->photo)}}
                @endif
                " class="profile-picture mx-auto d-block">
    </div>
    <br>
    <div class="container account-info">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Account information</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Username</th>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td>{{$user->email}}</td>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-dark float-right" href="{{route('users.edit')}}">Edit</a>
    </div>
@endsection
