<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') | {{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="imgs/favicon.svg" type="image/x-icon">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d81a69ccc9.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-dropdown')

        <!-- Page Content -->
        <main class="w-screen main-cnt">
            @yield('home', '')
            @yield('sidebar', '')
            <x-sidebar />
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>