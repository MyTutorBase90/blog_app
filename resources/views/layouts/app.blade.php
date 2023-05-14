<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body style="background: #eef1ff; min-height: 100vh;">
    @include('layouts.navbar')

    @yield('content')

    @include('layouts.js')
</body>
</html>
