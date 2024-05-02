<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Base Apps') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/verde/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/verde/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/verde/favicon-16x16.png">
    <link rel="manifest" href="/favicons/verde/site.webmanifest">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
