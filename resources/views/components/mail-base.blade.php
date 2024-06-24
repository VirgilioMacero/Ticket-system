@props(['title' => 'New Ticket Created'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FavIcon -->

    <link rel="icon" href="{{ asset('images/icono NSS.png') }}" type="image/x-icon">

    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">

    <div style="min-height: 100vh; background-color: rgb(243 244 246)" class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <div style="background-color:#eab308; height:100vh;" class="h-screen bg-yellow-500">
            {{ $slot }}
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
