<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel=""
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="icon" href="favicon.ico">
    <title>Appetito | @yield('title')</title>
    @yield('stylesheet')
    @vite('resources/scss/app.scss')
</head>
<body>

@include('partials.header')
@yield('content')
@include('partials.footer')

@vite('resources/js/app.js')
@yield('javascript')
</body>
</html>
