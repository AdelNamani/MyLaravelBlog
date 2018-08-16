<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap.css') }}">
    @yield('styles')
</head>
<body>
@include('partials.header')
@yield('content')

<script type="text/javascript" src="{{ URL::to('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/bootstrap.js') }}"></script>
@yield('scripts')
</body>
</html>