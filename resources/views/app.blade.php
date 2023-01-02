<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
        <style>
            .grid-cols-1 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            
            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            
            .grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            
            .grid-cols-4 {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
            
            .grid-cols-5 {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }
            
            .grid-cols-6 {
                grid-template-columns: repeat(6, minmax(0, 1fr));
            }
            
            .grid-cols-7 {
                grid-template-columns: repeat(7, minmax(0, 1fr));
            }
            </style>
    </head>
    <body class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 font-sans antialiased">
        @inertia
    </body>
</html>
