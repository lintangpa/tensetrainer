<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Adelsten - Re:Memories</title>
    <link rel="icon" href="{{URL::asset('/favicon/favicon.ico')}}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="antialiased">
    <script src="https://cdn.tailwindcss.com"></script>
    @include('layout.partials.nav')
    @yield('konten')
    @include('layout.partials.footer')

</body>

</html>
